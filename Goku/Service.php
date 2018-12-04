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
        if ( !isset($this->projectInstances[$name]) ) {
            $project = new Project($this->projects[$name]);
            $this->projectInstances[$name] = $project;
        }
        return $this->projectInstances[$name];
    }
}