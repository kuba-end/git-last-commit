<?php
namespace KubaEnd;

//require_once ('/home/ciecierzyca/PhpstormProjects/last_commit/src/Commands/Abstracts/CreateClient.php');
require_once ('/home/ciecierzyca/PhpstormProjects/last_commit/src/Commands/GitHubConnect.php');
require_once ('/home/ciecierzyca/PhpstormProjects/last_commit/src/Commands/Interfaces/ProcessResponseInterface.php');
use KubaEnd\Commands\Abstracts\CreateClient;
use KubaEnd\Commands\GitHubConnect;
use KubaEnd\Commands\Interfaces\ProcessResponseInterface;

class Platform extends CreateClient
{
    private $platform;
    public function __construct($platform){
        $this->platform=$platform;
    }
    public function getLastCommitSha($nick,$repo):object{
        return $this->platform->getLastCommitSha($nick,$repo);
    }
}
$platform = new Platform(new GitHubConnect());
var_dump($platform->getLastCommitSha('kuba-end','git-last-commit'));