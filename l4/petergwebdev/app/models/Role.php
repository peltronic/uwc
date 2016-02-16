<?php

use Zizaco\Entrust\EntrustRole;

// %FIXME: this should implement our Base Model class, but for now just duplicate the
// functionality...
class Role extends EntrustRole
{
    public static $selectOptionsConfig = array('key_field'=>'id','val_field'=>'name');
    /* DEPRECATED: use modelconfigs instead
    public static $editFormConfigs = array();
     */
    public static $editFormIgnores = array();

    public static $displayColumns = array(
        'base'=>array(
            'table'=>'roles',
            'prefix'=>'r',
            'namecol'=>'name',
            'cols'=>array('id'=>null,'name'=>'Name'),
        ),
        'joins'=>array(),
    );

    public static function getNameColumn($isPrefix=1) 
    {
        if ($isPrefix) {
            return self::$displayColumns['base']['prefix'].'_'.self::$displayColumns['base']['namecol'];
        } else {
            return self::$displayColumns['base']['namecol'];
        }
    }

    // %FIXME: see comment above
    public static function getDisplayListHeaders($displayColumns)
    {
        $dcB = $displayColumns['base'];
        $dcJ = $displayColumns['joins'];
        //$dcP = $displayColumns['pivots'];

        // order must match above
        $headers = array();

        foreach ($dcB['cols'] as $colName => $displayTitle) {
            $slug = $dcB['prefix'].'_'.$colName; // aka alias
            $qTerm = $dcB['prefix'].'.'.$colName; // full query term (for sql)
            $headers[$slug] = array('is_displayed'=>($displayTitle!=null), 'title'=>$displayTitle, 'q_term'=>$qTerm,
                                    //'form'=>array('type'=>'text'),
                              );
        }

        // join clauses (o2m)
        foreach ($dcJ as $j) {
            // %FIXME: here
            foreach ($j['list_cols'] as $colName => $displayTitle) {
                $JMODEL = $j['model'];
                $slug = $j['prefix'].'_'.$colName;
                $qTerm = $j['prefix'].'.'.$colName;
                // 'form' is for search form in sidebar
                $headers[$slug] = array('is_displayed'=>($displayTitle!=null), 'title'=>$displayTitle, 'q_term'=>$qTerm,
                                    //'form'=>array('type'=>'select','options'=>self::getSelectOptions($j['table'],$JMODEL::$selectOptionsConfig)),
                                  );
            }
        }

        // pivot clauses (m2m: display as comma-separated list within a record's column)
        if ( !empty($displayColumns['pivots']) ) {
            $dcP = $displayColumns['pivots'];
            foreach ($dcP as $p) {
                foreach ($p['cols'] as $colName => $displayTitle) {
                    $PMODEL = $p['dst_model'];
                    $slug = $p['dst_alias'].'_'.$colName;
                    $qTerm = $p['dst_alias'].'.'.$colName;
                    $headers[$slug] = array('is_displayed'=>($displayTitle!=null), 'title'=>$displayTitle, 'q_term'=>$qTerm,
                                        //'form'=>array('type'=>'select','options'=>self::getSelectOptions($p['dst_table'],$PMODEL::$selectOptionsConfig)),
                                    );
                }
            }
        }
        return $headers;

    } // getDisplayListHeaders()
    public static function getDisplayListRecords($displayColumns=null, $params=array())
    {
        // %FIXME: if $displayColumns is null choose a sensible default
        $dcB = $displayColumns['base'];
        $dcJ = $displayColumns['joins'];
        //$dcP = $displayColumns['pivots'];

        // base query
        $q = \DB::table($dcB['table'].' as '.$dcB['prefix']);

        // select & where terms (1 of 3)
        $selectTerms = array();
        $whereTerms = array();
        $selectTerms[] = $dcB['prefix'].'.id as pkid'; // Special case for primary key: pkid
        foreach (array_keys($dcB['cols']) as $c) {
            $alias = $dcB['prefix'].'_'.$c;
            $qt = $dcB['prefix'].'.'.$c;
            $selectTerms[] = $qt.' as '.$alias;
            $whereTerms[$alias] = array('type'=>'text','qterm'=>$qt); // needed below
        }

        // join clauses
        foreach ($dcJ as $j) {
            $q->join($j['table'].' as '.$j['prefix'], $j['prefix'].'.id', '=', $dcB['prefix'].'.'.$j['fk']);

            // select & where terms (2 of 3)
            foreach (array_keys($j['form_cols']) as $c) {
                $alias = $j['prefix'].'_'.$c;
                $qt = $j['prefix'].'.'.$c;
                //$selectTerms[] = $qt.' as '.$alias;
                $whereTerms[$alias] = array('type'=>'select','qterm'=>$qt); // needed below
            }
            foreach (array_keys($j['list_cols']) as $c) {
                $alias = $j['prefix'].'_'.$c;
                $qt = $j['prefix'].'.'.$c;
                $selectTerms[] = $qt.' as '.$alias;
                //$whereTerms[$alias] = array('type'=>'select','qterm'=>$qt); // needed below
            }
        }
        // pivot clauses
        $q->select($selectTerms);
        //{"c_id":"c.id","c_title":"c.title","c_name":"c.name","c_name_uri":"c.name_uri","c_name_keywords":"c.name_keywords"}

        // Ignore sorting & pagination params here
        unset($params['_order']); 
        unset($params['_dir']); 
        unset($params['page']); 

        // where clause: params should be in 'alias' format (see above)
        if ( count($params)>0 ) {
            $wherePhrases = array();
            $whereVals = array();
            foreach ($params as $k => $p) {
                if ( empty($p) ) continue;
                // use whereTerms here
//dd(json_encode($whereTerms));
                switch ($whereTerms[$k]['type']) {
                    case 'select': // form field type : select
                        $wherePhrases[] = $whereTerms[$k]['qterm'].' = ?'; 
                        $whereVals[] = $p;
                        break;
                    case 'text': // form field type: text
                        $wherePhrases[] = $whereTerms[$k]['qterm'].' LIKE ?';
                        $whereVals[] = '%'.$p.'%';
                        break;
                    default:
                }
            }
            if ( count($wherePhrases)>0 ) {
                $whereStr = implode(' and ',$wherePhrases);
                $q->whereRaw($whereStr,$whereVals);
            }
        }

        // Extract params for sorting (order by)
        // %FIXME: do this \Input access in controller? (otoh pagination directly 
        //   accesses \Input as well?)
        $sortParams = array('order'=>\Input::get('_order',0),'direction'=>\Input::get('_dir','asc'));
        if ($sortParams['order']) {
            $q->orderBy($sortParams['order'],($sortParams['direction']=='desc')?'desc':'asc');
        }

        // execute query & return results
        $records = $q->paginate( RECORDS_PER_INDEX_PAGE );
//dd($records->getCurrentPage());
//dd($records->getLastPage());
//dd($records->getPerPage());
//dd($records->getTotal());
        //$records = $q->get(10); // %FIXME: hardcoded
        //dd(\DB::getQueryLog());

        // Add on m2m (pivot) values in comma-separated format
        if ( !empty($displayColumns['pivots']) ) {
            $dcP = $displayColumns['pivots'];
            foreach ($dcP as $p) {
                // process a pivot field
                foreach ($records as $i => $r) {
                    // for each record...
                    foreach ($p['cols'] as $colName => $displayTitle) {
                        // ...process each column to show for this pivot field
                        $slug = $p['dst_alias'].'_'.$colName; // how the pivot field is keyed for display in template
                        $rels = self::getPivotRelationValues($p['dst_table'],$colName,$p['pivot_table'],$p['src_fk'],$p['dst_fk'],$r->pkid);
                        // Reformat for display....
                        $rels2 = array();
                        foreach ($rels as $k=>$v) {
                            $rels2[] = $v->$colName;
                        }
                        $records[$i]->{$slug} = implode(',',$rels2); 
                    }
                }
            }
        }

        return $records;

    } // getDisplayListRecords()

    public static function getSearchFormConfig($displayColumns)
    {
        $dcB = $displayColumns['base'];
        $dcJ = $displayColumns['joins'];
        //$dcP = $displayColumns['pivots'];

        // order must match above
        $formConfig = array();

        foreach ($dcB['cols'] as $colName => $displayTitle) {
            $slug = $dcB['prefix'].'_'.$colName; // aka alias
            $qTerm = $dcB['prefix'].'.'.$colName; // full query term (for sql)
            $formConfig[$slug] = array('is_displayed'=>($displayTitle!=null), 'title'=>$displayTitle, 'q_term'=>$qTerm,
                                    'form'=>array('type'=>'text'),
                              );
        }

        // join clauses (o2m)
        foreach ($dcJ as $j) {
            // %FIXME: here
            foreach ($j['form_cols'] as $colName => $displayTitle) {
                $JMODEL = $j['model'];
                $slug = $j['prefix'].'_'.$colName;
                $qTerm = $j['prefix'].'.'.$colName;
                // 'form' is for search form in sidebar
                $formConfig[$slug] = array('is_displayed'=>($displayTitle!=null), 'title'=>$displayTitle, 'q_term'=>$qTerm,
                                    'form'=>array('type'=>'select','options'=>self::getSelectOptions($j['table'],$JMODEL::$selectOptionsConfig)),
                                  );
            }
        }

        // pivot clauses (m2m: display as comma-separated list within a record's column)
        if ( !empty($displayColumns['pivots']) ) {
            $dcP = $displayColumns['pivots'];
            foreach ($dcP as $p) {
                foreach ($p['cols'] as $colName => $displayTitle) {
                    $PMODEL = $p['dst_model'];
                    $slug = $p['dst_alias'].'_'.$colName;
                    $qTerm = $p['dst_alias'].'.'.$colName;
                    $formConfig[$slug] = array('is_displayed'=>($displayTitle!=null), 'title'=>$displayTitle, 'q_term'=>$qTerm,
                                        'form'=>array('type'=>'select','options'=>self::getSelectOptions($p['dst_table'],$PMODEL::$selectOptionsConfig)),
                                    );
                }
            }
        }
        return $formConfig;

    } // getSearchFormConfig()

    // %%% ===========================

    public function users()
    {
        return $this->belongsToMany('User');
    }
}
