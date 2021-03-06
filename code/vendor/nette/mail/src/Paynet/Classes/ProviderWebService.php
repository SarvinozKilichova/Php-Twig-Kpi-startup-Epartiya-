<?php 


#namespace Nette\Mail\Classes;
namespace Nette\Mail\Classes;

use Telegram\Bot\Api;
use Event;
// use Application\Models\Settings;
// use Application\Models\Transaction;
use Nette\Mail\Classes\Types\GenericParam;
use Nette\Mail\Classes\Types\GetStatementResult;
use Nette\Mail\Classes\Types\GetInformationResult;
use Nette\Mail\Classes\Types\CancelTransactionResult;
use Nette\Mail\Classes\Types\PerformTransactionResult;
use Nette\Mail\Classes\Types\CancelTransactionArguments;
use Nette\Mail\Classes\Types\CheckTransactionArguments;
use Nette\Mail\Classes\Types\CheckTransactionResult;
use Nette\Mail\Classes\Types\GenericArguments;
use Nette\Mail\Classes\Types\GenericResult;
use Nette\Mail\Classes\Types\GetInformationArguments;
use Nette\Mail\Classes\Types\GetStatementArguments;
use Nette\Mail\Classes\Types\PerformTransactionArguments;
use Nette\Mail\Classes\Types\TransactionStatement;

class ProviderWebService {

	public $messages = [
		0   => "Проведено успешно",
		77  => "Недостаточно средств на счету клиента для отмены платежа",
		100 => "Услуга временно не поддерживается",
		101 => "Квота исчерпана",
		102 => "Системная ошибка",
		103 => "Неизвестная ошибка",
		201 => "Транзакция существует",
		202 => "Транзакция уже отменена",
		302 => "Пользователь не найден",
		401 => "Платеж уже существует",
		411 => "Не задан один или несколько обязательных параметров",
		412 => "Неверный логин",
		413 => "Неверная сумма",
		502 => "Клиент вне зоны обслуживания провайдера",
		601 => "Доступ запрещен"
	];

	public $username;

	public $password;

	public $serviceId;

	public $allowedIps = []; //["213.230.106.115"];


	public function __construct() {
		$this->username = "dvlotto";
		$this->password = "3mG@PtS8N%";
		$this->serviceId = "1";
		$this->paynetModel = \Application_App::getModel('paynet');
	}


	/**
	 * Service Call: PerformTransaction
	 * Parameter options:
	 * @param mixed arguments PerformTransactionArguments
	 * @return PerformTransactionResult
	 */
	public function PerformTransaction($arguments) {
		$parameters = [];
		$username = $arguments->username;
		$password = $arguments->password;
		$amount = $arguments->amount/100;
		$parameters = $arguments->parameters;
		$serviceId = $arguments->serviceId;
		$transactionId = $arguments->transactionId;
		$transactionTime = $arguments->transactionTime;
		$userId = is_array($parameters) ? $parameters[0]->paramValue : $parameters->paramValue;
		$isdn = 0; // номер нашей транзакции
		$status = 103; // стутус траназакции
		$balance = 0; // баланс плательщика
		$this->exit = 5;

		// теперь получим ип адрес запроса
		$ip = getenv('REMOTE_ADDR');
		if(in_array($ip, $this->allowedIps) || empty($this->allowedIps)) {
			$ipflag = 5;
		}

		// ип адрес из списка запрещенных
		if($ipflag !=5 ) {
			$status = 601;
			$this->exit = 2;
		} else {
			// *******************************************
			// теперь проверим логин на правильность
			if($username != $this->username) {
				$status = 412;
				$this->exit = 2;
			}

			// теперь проверим пароль на правильность
			if($password != $this->password) {
				$status = 601;
				$this->exit = 2;
			}

			// теперь проверим провайдера
			if($serviceId != 1) {
				$status = 502;
				$this->exit = 2;
			}

			// теперь проверим есть ли все остальные параметры
			if(empty($amount) or empty($userId) or empty($transactionId) or empty($transactionTime)) {
				$status = 411;
				$this->exit = 2;
			}

			if ($this->getAmount($amount) < 1) {
            	$status = 413;
            	$this->exit = 2;
        	}
			
			// here is coming business logic
			if ($this->exit!=2) {
				$transaction = $this->paynetModel->checkOnlyTrans($transactionId);
				if ($transaction) {
					$status = 201;
					$this->exit = 2;
				}

				if ($this->exit != 2) {
					$user = null;

			        $user = $this->paynetModel->checkUser($userId);

					if (!$user) {
						$status = 302;
						$this->exit = 2;
					}
				}
			}

			if ($this->exit != 2) {
				$transaction = [
					'trans_id' => '1001'.$transactionId,
					'user_id'  => $userId,
					'amount'   => $amount,
					'status'   => 1,
					'create_datetime' => date('Y-m-d H:i:s')
				];

				$params = [];
				$parameters = [];

				$transaction = $this->paynetModel->createTransaction($transaction);
				if ($transaction['result'] == 0) {					
					foreach ($params as $key => $value) {
						$parameter = new GenericParam();
						$parameter->paramKey = $key;
						$parameter->paramValue = $value;
						$parameters[] = $parameter;
					}
					$status = 0;
				} else {
					$status = $transaction['result'];
				}
			}
		}

		// тут мы выдаем ответ на запрос SOAP
		$result = new PerformTransactionResult();
		$result->providerTrnId = isset($transaction) ? $transaction['id'] : 0;
		$result->errorMsg = $this->messages[$status];
		$result->status = $status;
		$result->timeStamp = date('c', strtotime($transaction['create_datetime']));
		$result->parameters = $parameters;
		
		return $result;
	}


	/**
	 * Service Call: CheckTransaction
	 * Parameter options:
	 * @param mixed arguments CheckTransactionArguments
	 * @return CheckTransactionResult
	 */
	public function CheckTransaction($arguments) {
		// тут идет получение данных из SOAP
		$password = $arguments->password;
		$username = $arguments->username;
		$serviceId = $arguments->serviceId;
		$transactionId = $arguments->transactionId;

		// Установим предпарамметры
		$isdn = 0; // cвойства транзакции
		$status = 100; // стутус траназакции
		$transactionState = 0;
		$transactionStateErrorStatus = 0;
		$this->exit = 5;
		$ip=getenv('REMOTE_ADDR');
		if(in_array($ip, $this->allowedIps) || empty($this->allowedIps)){
			$ipflag = 5;
		}

		// ип адрес из списка запрещенных
		if($ipflag != 5) {
			$status = 601;
			$this->exit = 2;
		} else {
			// *******************************************
			// теперь проверим логин на правильность
			if($username != $this->username) {
				$status = 412;
				$this->exit = 5;
			}

			// теперь проверим пароль на правильность
			if($password != $this->password) {
				$status = 601;
				$this->exit = 2;
			}

			// теперь проверим провайдера
			if($serviceId!=1) {
				$st=502;
				$this->exit = 2;
			}

			// теперь проверим есть ли все остальные параметры
			if(!$transactionId){
				$status = 411;
				$this->exit = 2;
			}
			
			// here will coming business logic
			if ($this->exit != 2) {
				$transaction = $this->paynetModel->checkTrans($transactionId);

				if (!$transaction) {
					$status = 201;
					$this->exit = 2;
					$isdn = 0;
				} else {
					$status = 0;
					$isdn = $transaction['id'];
					$transactionState = 1;
					$transactionStateErrorStatus = 0;
					if ($transaction['status'] < 1) {
						$transactionState = 2;
						$transactionStateErrorStatus = 1;
					}
				}
			}
		}

		// тут мы выдаем ответ на запрос SOAP
		$result = new CheckTransactionResult();
		$result->errorMsg = $this->messages[$status];
		$result->status = $status;
		$result->timeStamp = date('c');
		$result->providerTrnId = $isdn;
		$result->transactionState = $transactionState;
		$result->transactionStateErrorStatus = $transactionStateErrorStatus;
		$result->transactionStateErrorMsg = "Success";

		return $result;
	}

	/**
	 * Service Call: CancelTransaction
	 * Parameter options:
	 * @param mixed arguments CancelTransactionArguments
	 * @return CancelTransactionResult
	 */
	public function CancelTransaction($arguments) {
		// тут идет получение данных из SOAP
		$password = $arguments->password;
		$username = $arguments->username;
		$serviceId = $arguments->serviceId;
		$transactionId = $arguments->transactionId;

		// Установим предпарамметры
		$isdn = 0; // cвойства транзакции
		$status = 202; // стутус траназакции
		$this->exit = 5;
		$ip=getenv('REMOTE_ADDR');

		// теперь проверим на ликвидность
		if(in_array($ip, $this->allowedIps) || empty($this->allowedIps)){
			$ipflag = 5;
		}

		$transaction = $this->paynetModel->checkTrans($transactionId);

		if (!$transaction) {
			$status = 201;
			$this->exit = 2;
		}
		
		if ($transaction && $transaction['status'] == '0') {
			$status = 202;
			$this->exit = 2;
		} else {
			$status = 77;

			$transaction = $this->paynetModel->cancelPay($transactionId);
			$status = $transaction['result'];

		}
		
		// тут мы выдаем ответ на запрос SOAP
		$result = new CancelTransactionResult();
		$result->errorMsg = $this->messages[$status];
		$result->status = $status;
		$result->timeStamp = date("c");
		$result->transactionState = 2;
		
		return $result;
	}

	/**
	 * Service Call: GetStatement
	 * Parameter options:
	 * @param mixed arguments GetStatementArguments
	 * @return GetStatementResult
	 */
	public function GetStatement($arguments) {
		// тут идет получение данных из SOAP
		$dateFrom = $arguments->dateFrom;
		$dateTo = $arguments->dateTo;
		$password = $arguments->password;
		$serviceId = $arguments->serviceId;
		$username = $arguments->username;

		// Установим предпарамметры
		$status = 103; // стутус траназакции
		$this->exit = 5;
		// теперь получим ип адрес запроса
		$ip=getenv('REMOTE_ADDR');
		// теперь проверим на ликвидность
		if(in_array($ip, $this->allowedIps) || empty($this->allowedIps)){
			$ipflag = 5;
		}

		// ип адрес из списка запрещенных
		if($ipflag != 5) {
			$status = 601;
			$this->exit = 2;
		} else {
			// *******************************************
			// теперь проверим логин на правильность
			if($username != $this->username) {
				$status = 412;
				$this->exit = 2;
			}

			// теперь проверим пароль на правильность
			if($password != $this->password) {
				$status = 601;
				$this->exit = 2;
			}

			// теперь проверим провайдера
			if($serviceId != 1) {
				$status = 502;
				$this->exit = 2;
			}

			// теперь проверим есть ли все остальные параметры
			if(empty($dateFrom) or empty($dateTo)){
				$status = 411;
				$this->exit = 2;
			}
			
			$statements = [];
			// here will coming business logic
			if ($this->exit != 2) {
				$status = 0;

				$transactions = $this->paynetModel->getStat($dateFrom, $dateTo);
				foreach ($transactions as $key => $value) {
					$statement = new TransactionStatement();
					$statement->amount = $value['amount'] * 100;
					$statement->providerTrnId = $value['id'];
					$statement->transactionId = $value['trans_id'];
					$statement->transactionTime = date('c', strtotime($value['create_datetime']));
					$statements[] = $statement;
				}
			}
		}

		// тут мы выдаем ответ на запрос SOAP
		$result = new GetStatementResult();
		$result->errorMsg = $this->messages[$status];
		$result->status = $status;
		$result->timeStamp = date("c");
		$result->statements = $statements;
		
		return $result;
	}

	/**
	 * Service Call: GetInformation
	 * Parameter options:
	 * @param mixed arguments GetInformationArguments
	 * @return GetInformationResult
	 */
	public function GetInformation($arguments) {
		print_r('ddd');
		exit();
		// тут идет получение данных из SOAP
		$username = $arguments->username;
		$password = $arguments->password;
		$parameters = $arguments->parameters;
		$serviceId = $arguments->serviceId;
		$userId = is_array($parameters) ? $parameters[0]->paramValue : $parameters->paramValue;

		// Установим предпарамметры
		$status = 103; // стутус траназакции
		$balance = 0; // баланс плательщика
		$this->exit = 5;
		// теперь получим ип адрес запроса
		$ip=getenv('REMOTE_ADDR');
		// теперь проверим на ликвидность
		if(in_array($ip, $this->allowedIps) || empty($this->allowedIps)){
			$ipflag=5;
		}

		// ип адрес из списка запрещенных
		if($ipflag != 5) {
			$status = 601;
			$this->exit = 2;
		} else {

			// *******************************************
			// теперь проверим логин на правильность
			if($username != $this->username) {
				$status = 412;
				$this->exit = 2;
			}

			// теперь проверим пароль на правильность
			if($password != $this->password) {
				$status = 601;
				$this->exit = 2;
			}

			// теперь проверим провайдера
			if($serviceId != 1) {
				$status = 502;
				$this->exit = 2;
			}

			// теперь проверим есть ли все остальные параметры
			if(empty($userId)){
				$status = 411;
				$this->exit = 2;
			}
			
			$user = null;

			// теперь проверим user

			$user = $this->paynetModel->checkUser($userId);
			if (!$user) {
				$status = 302;
				$this->exit = 2;
			}
			
			// here will coming business logic
			if ($this->exit != 2) {
				$status = 0;
				$this->exit = 5;

				$params = [];
				$parameters = [];
				// Event::fire('shohabbos.paynet.getInformation', [$userId, &$params]);

				foreach ($params as $key => $value) {
					$parameter = new GenericParam();
					$parameter->paramKey = $key;
					$parameter->paramValue = $value;
					$parameters[] = $parameter;
				}
			}
		}

		// тут мы выдаем ответ на запрос SOAP
		$result = new GetInformationResult();
		$result->errorMsg = $this->messages[$status];
		$result->status = $status;
		$result->timeStamp = date("c");
		$result->parameters = $parameters;
		
		return $result;
	}


	protected function getAmount($amount) {
        return ($amount / 100);
    }
}
