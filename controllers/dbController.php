<?php


class dbController extends configController{
    private $bddserver = '127.0.0.1';
    private $bddname = '';
    private $bdduser = 'root';
    private $bddpassword = '';
    private $bdddriver = '';
    private $bddlink;
    
    function __construct(){
        
        parent::__construct();
        
        $config = parent::getConfigParameter('dbconfig');
        
        foreach($config as $key=>$value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
        
        $dsn = $this->bdddriver.':dbname='.$this->bddname.';host='.$this->bddserver;
        try {
            $this->bddlink = new PDO($dsn , $this->bdduser, $this->bddpassword);
            $this->bddlink -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Failed:' . $e->getMessage();
        }
    }
    
    function request(object $objet, array $options=array()){
        try{ 
        $table=get_class($objet); //récupère la classe de mon objet 
        $champs= '*'; 
        if(isset($options['champs']) && !empty($options)){ 
            $champs = implode(',',$options['champs']); 
        }
        if(!isset($options['criteria'])){ 
            throw new Exception(__METHOD__.' '.__LINE__.': criteria doit être défini'); 
        }
        $query = 'SELECT ' .$champs.' FROM '.$table.' WHERE '; 
        $nbCriteria = count(array_keys($options['criteria'])); 
        $keys = array_keys($options['criteria']);
        
        for($i=0; $i<$nbCriteria; $i++){ 
            if($i>0){ 
                $query .= ' AND '; 
            }
            $query .= $keys[$i].' = :'.$keys[$i]; 
        } 
        $query .=' LIMIT 1';
        $req = $this->bddlink->prepare($query); 
        $req -> execute($options['criteria']);
        $result = $req->fetch(PDO::FETCH_ASSOC); //fetch et pas fetch_all car un seul enregirstrement à récup 
        return $result; 
        }
        
        catch (Exception $ex){ 
            echo $ex->getMessage(); 
            return array();   
        } 
    }
    
    function requestById(object $objet, $id){
        return $this->request($objet, 
                array('criteria' => array(
                    'id'=>$id
                )
            ));
    }
    
    function insert(object $objet, array $options = array()){
        try{
            if(!isset($options['criteria'])){ 
                throw new Exception(__METHOD__.' '.__LINE__.': criteria doit être défini'); 
            }
            $table = get_class($objet);
            $query = 'INSERT INTO '.$table.' (';
            $nbcriteria = count(array_keys($options));
            $keys = array_keys($options);
            for($i = 0; $i<$nbcriteria; $i++){
                $query .= $keys[$i];
                if($i!=$nbcriteria-1){ 
                    $query .= ', '; 
                }
            }
            $query .= ') VALUES (';
            for($i = 0; $i<$nbcriteria; $i++){
                $query .= ':'.$keys[$i];
                if($i!=$nbcriteria-1){ 
                    $query .= ', '; 
                }
            }
            $query .= ')';
            //echo $query;
            //var_dump($options['criteria']); var_dump($objet); 
            //die();
            //var_dump($this);
            $req = $this->bddlink->prepare($query);
            $req->execute($options); 
            return array(true);
        } catch (Exception $ex) {
            echo $ex->getMessage(); 
            return array();
        }
    }
    
    function findObjectById(object $object, $id){
        $datas = $this->requestById($object, $id);
        $this->hydrateRecord($object, $datas);
    }
    
    function hydrateRecord(object $object, array $datas){
        foreach ($datas as $key=>$value){
            $method = 'set'.ucfirst($key);
            if(method_exists($object, $method)){
                $object->$method($value);
            }
        }
    }
    
    function update(object $objet, array $options = array()){
        try {
            if(!isset($options['criteria'])){ 
                throw new Exception(__METHOD__.' '.__LINE__.': criteria doit être défini'); 
            }
            $table = get_class($objet);
            $query = 'UPDATE '.$table.' SET ';
            $nbcriteria = count(array_keys($options));
            $criteria = array_keys($options);
            for($i = 0; $i < $nbcriteria; $i++){
                $query .= $criteria[$i].' = :'.$criteria[$i];
                if($i!=$nbcriteria-1){ 
                    $query .= ', ';
                }
            }
            $query .= ' WHERE '.$criteria[0].' = :'.$criteria[0];
            //var_dump($query); die();
            $req = $this->bddlink->prepare($query);
            $req->execute($options); 
            return array(true);
        } catch (Exception $ex) {
            echo $ex->getMessage(); 
            return array();
        }
    }
    
    function getBddserver() {
        return $this->bddserver;
    }

    function getBddname() {
        return $this->bddname;
    }

    function getBdduser() {
        return $this->bdduser;
    }

    function getBddpassword() {
        return $this->bddpassword;
    }

    function setBddserver($bddserver) {
        $this->bddserver = $bddserver;
    }

    function setBddname($bddname) {
        $this->bddname = $bddname;
    }

    function setBdduser($bdduser) {
        $this->bdduser = $bdduser;
    }

    function setBddpassword($bddpassword) {
        $this->bddpassword = $bddpassword;
    }


    function getBdddriver() {
        return $this->bdddriver;
    }

    function getBddlink() {
        return $this->bddlink;
    }

    function setBdddriver($bdddriver) {
        $this->bdddriver = $bdddriver;
    }

    function setBddlink($bddlink) {
        $this->bddlink = $bddlink;
    }


}
