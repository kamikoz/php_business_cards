<?php
require_once(__DIR__ . "/BusinessCardPOSTValidator.php");
require_once(__DIR__ . "/BusinessCardHydrator.php");
require_once(__DIR__ . "/BusinessCardMySQLRepository.php");
require_once(__DIR__ . "/BusinessCardService.php");

class HomeController
{
    private string $action;
    private string $postAction;
    private BusinessCardPOSTValidator $businessCardPOSTValidator;
    private BusinessCardService $businessCardService;
    private BusinessCardHydrator $businessCardHydrator;
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
            $this->postAction = filter_input(INPUT_POST, SEARCHING_METHOD_FORM, FILTER_DEFAULT) ?? "";
        }

        try {
            $this->businessCardPOSTValidator = new BusinessCardPOSTValidator($_POST?? []);
            $this->businessCardService = new BusinessCardService(new BusinessCardMySQLRepository());
            $this->businessCardHydrator = new BusinessCardHydrator();
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
                    $dataPOST = $this->businessCardPOSTValidator->validatePOSTData($this->postAction === SEARCHING_METHOD_FORM);
                    if ($this->postAction === SEARCHING_METHOD_FORM) {
                        $this->businessCards = $this->businessCardService->searchBusinessCardsByFields($dataPOST);
                    } else {
                        $businessCard = $this->businessCardHydrator->hydrate($dataPOST, new BusinessCard());
                        $businessCardID = $this->businessCardService->saveBusinessCard($businessCard);
                        $this->businessCards = $this->businessCardService->searchBusinessCardByID($businessCardID);
                    }
                    $this->view[] = "view/business_cards_list.php";
                } catch (Exception $e) {
                    $this->view[] = "view/error_message.php";
                    if ($this->postAction === SEARCHING_METHOD_FORM) {
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

