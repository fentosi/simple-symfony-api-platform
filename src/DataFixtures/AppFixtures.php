<?php

namespace App\DataFixtures;

use App\Entity\Item;
use App\Entity\Order;
use App\Entity\OrderItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $item1 = new Item();
        $item1->setName("The best item ever");
        $item1->setPrice(10);
        $manager->persist($item1);

        $item2 = new Item();
        $item2->setName("The next best");
        $item2->setPrice(20);
        $manager->persist($item2);

        $item3 = new Item();
        $item3->setName("The third");
        $item3->setPrice(30);
        $manager->persist($item3);

        $orderItem = new OrderItem();
        $orderItem->setCreatedDateTime(new \DateTime('now'));
        $orderItem->setAmount(1);
        $orderItem->setPrice(1 * $item1->getPrice());
        $orderItem->setItem($item1);

        $orderItem2 = new OrderItem();
        $orderItem2->setCreatedDateTime(new \DateTime('now'));
        $orderItem2->setAmount(2);
        $orderItem2->setPrice(2 * $item2->getPrice());
        $orderItem2->setItem($item2);


        $order = new Order();
        $order->setCreatedDateTime(new \DateTime('now'));
        $order->setOrderTotal(50);
        $order->addOrderItem($orderItem);
        $order->addOrderItem($orderItem2);

        $manager->persist($orderItem);
        $manager->persist($orderItem2);
        $manager->persist($order);

        $orderItem3 = new OrderItem();
        $orderItem3->setCreatedDateTime(new \DateTime('now'));
        $orderItem3->setAmount(1);
        $orderItem3->setPrice(1 * $item3->getPrice());
        $orderItem3->setItem($item3);

        $orderItem2 = new OrderItem();
        $orderItem2->setCreatedDateTime(new \DateTime('now'));
        $orderItem2->setAmount(1);
        $orderItem2->setPrice(1 * $item2->getPrice());
        $orderItem2->setItem($item2);

        $order2 = new Order();
        $order2->setCreatedDateTime(new \DateTime('now'));
        $order2->setOrderTotal(50);
        $order2->addOrderItem($orderItem3);
        $order2->addOrderItem($orderItem2);

        $manager->persist($orderItem3);
        $manager->persist($orderItem2);

        $manager->persist($order2);

        $manager->flush();
    }
}
