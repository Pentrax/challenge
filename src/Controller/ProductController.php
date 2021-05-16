<?php

namespace App\Controller;

use App\Service\CatalogService;
use App\Service\ClientService;
use App\Service\FileService;
use App\Service\ProductsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    protected $fileService;
    protected $productsService;
    protected $catalogService;
    protected $clientService;

    public function __construct(FileService $fileService, ProductsService $storeProductsService,CatalogService $catalogService,ClientService $clientService)
    {
        $this->fileService = $fileService;
        $this->productsService = $storeProductsService;
        $this->catalogService = $catalogService;
        $this->clientService = $clientService;
    }

    /**
     * @Route("/product", name="product")
     * This function get a test files for the test
     */
    public function getFile()
    {
        $this->generateCsv();
        $file = $this->fileService->getFile($this->getParameter('kernel.project_dir') . '/public/stored/','products.json');
        $this->decodeJsonFile($file);
    }

    /**
     * @param $file
     * Decode the Json File to Array associative
     */
    private function decodeJsonFile($file)
    {
        $products = $this->fileService::decodeJsonFile($file);

        if (!is_null($products)){
            $catalog = $this->createCatlogForProducts();

            $this->store($products,$catalog);
        }

        throw new \Exception("Products can´t be NULL");
    }

    public function createCatlogForProducts():object{
        return $this->catalogService->setCatalogSaved();
    }

    /**
     * @param $products
     * @throws \Doctrine\DBAL\Exception
     * Store the products
     */
    private function store($products,$catalog){

        $products = $this->productsService->store($products,$catalog);
        /**
         * Send the products
         */
        $this->sendToClient('https://client.com',$products);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendToClient($url,$products){

       $this->clientService->sendToClient($url,$products);
    }

    /**
     * @param $catalog_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function generateCsv($catalog_id){
        return $this->fileService->generateCsv($catalog_id);

    }

    /**
     * @return string
     */
    public function sendCsvToServer(){

        return $this->clientService->sendCsvToServer($this->getParameter('kernel.project_dir') . '/public/stored/','products.csv');

    }


}
