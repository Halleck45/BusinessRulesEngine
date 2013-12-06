<?php

/**
 * Business rule engine
 * Usage:
 *  BRE('x > 5', ['x' => 6]
 *  BRE('x => x > 5', 6]
 *
 *
 * @param string $expression
 * @param array $variables
 * @return mixed
 */
function BRE($expression, $variables) {

    if(preg_match('!^(.*?)\s=>\s*!', $expression, $m)) {
        list(, $varname) = $m;
        $variables = [$varname => $variables];
        $expression = preg_replace('!(^.*\s=>\s*)!', '', $expression);
    }
    $language = new \Symfony\Component\ExpressionLanguage\ExpressionLanguage();
    return $language->evaluate($expression, $variables);
}