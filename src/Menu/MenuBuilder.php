<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    public function __construct(
        private FactoryInterface $factory,
        private RequestStack     $requestStack
    )
    {
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $currentRequest = $this->requestStack->getCurrentRequest();
        $currentRoute = $currentRequest ? $currentRequest->attributes->get('_route') : null;

        $menu->addChild('Home', ['route' => 'app_dashboard']);
        $menu->addChild('Competitions', ['route' => 'user_competition']);


        foreach ($menu->getChildren() as $child) {
            if ($child->getExtra('routes')[0]['route'] === $currentRoute) {
                $child->setCurrent(true);
            }
        }

        return $menu;
    }
}
