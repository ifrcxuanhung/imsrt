<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */
$route['first'] = "welcome/start";
$route['jq_loadtable/(:any)'] = "welcome/jq_loadtable/index/$1";
$route['jq_compare/(:any)'] = "welcome/jq_compare/index/$1";
$route['jq_compare_two/(:any)'] = "welcome/jq_compare_two/index/$1";
$route['reports/(:any)'] = "welcome/jq_hierarchy/index/$1";
$route['jq_hierarchy/(:any)'] = "welcome/jq_hierarchy/index/$1";

$route['indice/(:any)'] = "welcome/jq_realtime/index/$1";
$route['stock/(:any)'] = "welcome/jq_stockpage/index/$1";
$route['news/(:any)'] = "welcome/news/index/$1";	//http://localhost/upmd/news/$page/abcd.html //http://localhost/upmd/news/$page
$route['category/(:any)/(:any)'] = "welcome/category/index/$1/$2";
$route['category/(:any)/(:any)/(:any)'] = "welcome/article/category/$1/$2";		//http://localhost/upmd/category/$idcat/$page/abcd.html
//$route['category/(:any)/(:any)'] = "welcome/article/category/$1";	
$route['category/(:any)'] = "welcome/category/index/$1";	//http://localhost/upmd/category/$idcat/abcd.html
$route['article/(:any)/(:any)/(:any)'] = "welcome/article/index/$1/$2";	//http://localhost/upmd/article/$idcat/$idart/abcd.html
$route['art_vnefrc/(:any)/(:any)/(:any)'] = "welcome/art_vnefrc/index/$1/$2";	//http://localhost/upmd/article/$idcat/$idart/abcd.html
$route['table/(:any)/(:any)'] = "welcome/table/index/$1/$2";  // table/category
$route['table/(:any)'] = "welcome/table/index/$1";
$route['info/(:any)'] = "welcome/info/index/$1";

// JQGRID 

//$route['default_controller'] = "welcome/maintenance";
$route['default_controller'] = "welcome";
$route['404_override'] = '';
$route['admin'] = "";
$route['admin/(:any)'] = "";
$route['auth'] = "auth";
$route['auth/(:any)'] = "auth/$1";
$route['webservices'] = "webservices";
$route['webservices/(:any)'] = "webservices/$1";

$route['restful'] = "restful";
$route['restful/(:any)'] = "restful/$1";
$route[$this->config->item('admin_url')] = "admin";
$route[$this->config->item('admin_url') . '/(:any)'] = "admin/$1";
$route['(:any)'] = "welcome/$1";
$route['test/(:any)'] = "welcome/test/index";
$route['datatable_test/(:any)'] = "welcome/datatable_test/index";
$route['maintenance'] = "maintenance";
$route['maintenance/(:any)'] = "maintenance/$1";


// new
//$route['jq_efrc_currency_data/(:any)'] = "welcome/jq_efrc_currency_data/$1";




//$route['testurl'] = "welcome/article/category/9/actualites-3.html";


/* End of file routes.php */
/* Location: ./application/config/routes.php */






