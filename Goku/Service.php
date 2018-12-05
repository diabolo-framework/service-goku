<?php
namespace X\Service\Goku;
use X\Core\Service\XService;
class Service extends XService {
    /**
     * 项目配置
     * @var array
     * */
    protected $projects = array();
    
    /**
     * 项目实例缓存
     * @var Project[]
     */
    private $projectInstances = array();
    
    
    /**
     * 获取项目实例
     * @param unknown $name
     * @return Project
     */
    public function getProject( $name ) {
        if ( !$this->hasProject($name) ) {
            throw new GokuException("project {$name} does not exists");
        }
        if ( !isset($this->projectInstances[$name]) ) {
            $project = new Project($this->projects[$name]);
            $this->projectInstances[$name] = $project;
        }
        return $this->projectInstances[$name];
    }
    
    /**
     * 判断项目是否存在
     * @param unknown $name
     * @return unknown
     */
    public function hasProject( $name ) {
        return isset($this->projects[$name]);
    }
}