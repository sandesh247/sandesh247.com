<?php

class gdtt_Taxonomy {
    var $name;
    var $label;
    var $object_type;
    var $hierarchical;
    var $rewrite;
    var $query_var;

    function gdtt_Taxonomy($saved_tax) {
        $this->name = $saved_tax["name"];
        $this->label = $saved_tax["label"];
        $this->object_type = $saved_tax["domain"];
        $this->hierarchical = $saved_tax["hierarchy"];
        $this->rewrite = $rewrite;
        $this->query_var = $query_var;
    }
}

?>