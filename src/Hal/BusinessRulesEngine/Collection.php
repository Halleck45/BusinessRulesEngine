<?php
namespace Hal\BusinessRulesEngine;


class Collection implements \IteratorAggregate, \Countable {
    /**
     * Datas
     *
     * @var Traversable
     */
    private $datas;

    /**
     * Clauses used for filtering, as string
     *
     * @var array
     */
    private $clauses = [];

    /**
     * Internal flag
     * @var bool
     */
    private $initialized = false;

    /**
     * Constructor
     *
     * @param array $datas
     */
    public function __construct($datas) {
        $this->datas = $datas;
    }

    /**
     * Add a where clause
     * ->where('x => x > 5')
     *
     * @param $clause
     * @return $this
     */
    public function where($clause) {
        array_push($this->clauses, $clause);
        return $this;
    }

    /**
     * Push item in the stack
     *
     * @param $item
     * @return $this
     */
    public function push($item) {
        array_push($this->datas, $item);
        return $this;
    }

    /**
     * Get datas (implementation of IteratorAggregate)
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator() {
        $this->doFilter();
        return new \ArrayIterator($this->datas);
    }

    /**
     * Get number of valid items
     *
     * @return integer
     */
    public function count() {
        $this->doFilter();
        return sizeof($this->datas);
    }

    /**
     * Filter datas
     *
     * @return void
     */
    protected  function doFilter() {
        if(!$this->initialized) {
            foreach($this->datas as $key => $data) {
                foreach($this->clauses as $clause) {
                    if(!BRE($clause, $data)) {
                        unset($this->datas[$key]);
                    }
                }
            }
            $this->datas = array_values($this->datas);
            $this->initialized = true;
        }
    }
}