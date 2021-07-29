<?php

namespace sterkado\crontab\components;

/**
 * Creates an array of routes from console controller actions
 * @example:
 * $extractor = new RouteExtractor($classname);
 * $extractor->getRoutes();
 */
class RouteExtractor extends \ReflectionClass
{
    /**
     * Exctract routes from class methods and make them absolute
     * @return array
     */
    public function getRoutes(): array
    {
        $class = preg_replace("/Controller$/", '', $this->getShortName());

        $routes = [];

        foreach ($this->getMethods() as $method) {

            if (preg_match("/^action[0-9A-Z]/", $method->name)) {

                $action = preg_replace("/^action/", '', $method->name);

                $route = strtolower("/" . $this->hyphenize($class) . "/" . $this->hyphenize($action));

                $routes[$route] = $route;
            }
        }

        return $routes;
    }

    /**
     * Split string by capital letters and concatinate with hyphens
     * @param string $string
     * @return string
     */
    public function hyphenize($string): string
    {
        $array = preg_split("/(?=[A-Z])/", lcfirst($string));

        return implode('-', $array);
    }
}
