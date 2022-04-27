<?php
require_once(__DIR__ . "/BusinessCardMySQLCRUD.php");
require_once(__DIR__ . "/BusinessCardService.php");

class HomeController
{
    private string $action;
    private string $postAction;
    private BusinessCardService $businessCardService;
    private string $errorMessage;
    private int $errorCode;
    private array $view;
    private array $businessCards;

    public function __construct()
    {
        $this->view = [];
        $this->businessCards = [];
        $this->errorMessage = "";
        $this->errorCode = 0;

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT) ?? "";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->action = "post";
            $this->postAction = filter_input(INPUT_POST, BusinessCardService::SEARCHING_METHOD_FORM, FILTER_DEFAULT) ?? "";
        }

        try {
            $this->businessCardService = new BusinessCardService(new BusinessCardMySQLCRUD());
        } catch (Exception $e) {
            $this->view[] = "view/error_message.php";
            $this->errorMessage = $e->getMessage();
            $this->errorCode = $e->getCode();
        }
    }

    public function indexAction(): void
    {
        switch ($this->action) {
            case 'add':
                $this->view[] = "view/form_add.php";
                break;
            case 'search':
                $this->view[] = "view/form_search.php";
                break;
            case 'post':
                try {
                    if ($this->postAction === BusinessCardService::SEARCHING_METHOD_FORM) {
                        $this->businessCards = $this->businessCardService->searchBusinessCardsByFieldsFromPOST();
                    } else {
                        $businessCardID = $this->businessCardService->saveBusinessCardFromPOST();
                        $this->businessCards = $this->businessCardService->searchBusinessCardByID($businessCardID);
                    }
                    $this->view[] = "view/business_cards_list.php";
                } catch (Exception $e) {
                    $this->view[] = "view/error_message.php";
                    if ($this->postAction === BusinessCardService::SEARCHING_METHOD_FORM) {
                        $this->view[] = "view/form_search.php";
                    } else {
                        $this->view[] = "view/form_add.php";
                    }
                    $this->errorMessage = $e->getMessage();
                    $this->errorCode = $e->getCode();
                }
                break;
            case 'index':
            default:
                try {
                    $this->businessCards = $this->businessCardService->getAllBusinessCards();
                    $this->view[] = "view/business_cards_list.php";
                } catch (Exception $e) {
                    $this->view = ["view/error_message.php"];
                    $this->errorMessage = $e->getMessage();
                    $this->errorCode = $e->getCode();
                }
        }
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @return int|mixed
     */
    public function getErrorCode(): mixed
    {
        return $this->errorCode;
    }

    /**
     * @return array
     */
    public function getView(): array
    {
        return $this->view;
    }

    /**
     * @return array
     */
    public function getBusinessCards(): array
    {
        return $this->businessCards;
    }
}

