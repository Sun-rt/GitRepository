<?php

class StatArticle extends AppModel {
    public $name = 'StatArticle';
    
    public $useTable = 'article_stat';  
    
    var $useDbConfig = 'logs';
}