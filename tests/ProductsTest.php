<?php


namespace App\Tests;


use App\Entity\Catalog;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductsTest extends KernelTestCase
{
    /** @var EntityManagerInterface */
    private $em;
    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        DatabasePrimer::prime($kernel);

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null;
    }

    public function testItWorks(){

        $this->assertTrue(true);
    }

    public function testStoreProducts(){
        $catalog = new Catalog();
        $catalog->setState('saved');
        $this->em->persist($catalog);
        $this->em->flush();

        $product_obj = new Products();
        $product_obj->setStyleNumber('ABC|1228');
        $product_obj->setName('T-Shirt');
        $product_obj->setAmount(1500);
        $product_obj->setCurrency('USD');
        $product_obj->setImages(["https://via.placeholder.com/400x300/4b0082?id=1",
                                    "https://via.placeholder.com/400x300/4b0082?id=2"]
                                );
        $product_obj->setCatalog($catalog);

        $this->em->persist($product_obj);

        $product = $this->em->getRepository(Products::class)->findOneBy(['styleNumber' => 'ABC|1228']);

        $this->assertEquals('ABC|1228',$product->getStyleNumber());
        $this->assertEquals('T-Shirt',$product->getName);
        $this->assertEquals(1500,$product->getAmount());
        $this->assertEquals('USD',$product->getCurrency());
        $this->assertEquals(["https://via.placeholder.com/400x300/4b0082?id=1",
                            "https://via.placeholder.com/400x300/4b0082?id=2"],$product->getImages());

    }

    public function testStoreCatalogSaved(){
        $catalog = new Catalog();
        $catalog->setState('saved');
        $this->em->persist($catalog);
        $this->em->flush();

        $catalog_saved = $this->em->getRepository(Catalog::class)->findOneBy(['state'=> 'saved']);

        $this->assertEquals('saved',$catalog_saved->getState());

    }

    public function testGetJsonFile(){
        // Todo
    }

    public function testSendClient(){
        // Todo
    }

    public function testSendCsvToServer(){
        // Todo
    }

    public function testMakeCsvFile(){
        // Todo
    }



}
