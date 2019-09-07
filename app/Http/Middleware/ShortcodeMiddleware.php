<?php

namespace App\Http\Middleware;

use Closure;
use App\Group;
use App\Report;
use App\Data;
use App\Entity;

class ShortcodeMiddleware
{
  /**
  * Handle an incoming request.
  *
  * @param \Illuminate\Http\Request $request
  * @param \Closure                 $next
  *
  * @return mixed
  */
  public function handle($request, Closure $next)
  {
    $responce = $next($request);
    if (!method_exists($responce, 'content')) {
      return $responce;
    } else {
      $routeParameters = $request->route()->parameters();
      $routeParameters = array_values($routeParameters);

      function menu_getter($responceContent, $routeParameters)
      {

        $preg_match_all = "/\[sc0\-g\-menu var=``\]((.|\n)*?)\[twig\]((.|\n)*?)\[inner_twig\]((.|\n)*?)\[\/twig\]((.|\n)*?)\[leaf\]((.|\n)*?)\[\/leaf\]((.|\n)*?)\[\/sc0\-g\-menu\]/";

        preg_match_all($preg_match_all, $responceContent, $matches);
        if (!empty($matches[0])) {
          function page_list($VPgsLocs, $value, $preg_match_all)
          {

            if (!empty($VPgsLocs)) {
              foreach ($VPgsLocs as $key => $value2) {
                preg_match_all($preg_match_all, $value, $matches);

                if (is_array($value2)) {
                  $matches[3][0] = str_replace('[link]', $value2['url'], $matches[3][0]);
                  $matches[3][0] = str_replace('[name]', $value2['name'], $matches[3][0]);

                  echo  $matches[3][0];

                  page_list($value2['content'], $value, $preg_match_all);
                  echo  $matches[5][0];
                } else {
                  if ('url' !== $key) {
                    $matches[9][0] = str_replace('[name]', $value2['name'], $matches[9][0]);
                    $matches[9][0] = str_replace('[link]', $value2, $matches[9][0]);
                    echo  $matches[9][0];
                  }
                }
              }
            }
          }
          // dd($matches[0]);
          foreach ($matches[0] as $key => $value) {
            if (!empty($routeParameters)) {
              $routeParameters = array_values($routeParameters);
              $arguments2[0] = $routeParameters[0];

              $Slug = null;

              $BaseEntityType = 'Group';
              $BaseEntityID = Group::ShowID($routeParameters);
              $EntityType ='Report';

              $VPgsLocs = Entity::ShowMulti($BaseEntityType,$BaseEntityID, $EntityType,$Slug);

              ob_start();

              if (is_array($VPgsLocs)) {
                page_list($VPgsLocs, $value, $preg_match_all);
              }

              $result = ob_get_contents();
              ob_end_clean();

              $responceContent = str_replace($value, $result, $responceContent);
            } else {
              $responceContent = str_replace($value, null, $responceContent);
            }
          }
        }


        return $responceContent;
      }

      function data_getter($responceContent, $routeParameters)
      {
        preg_match_all('/\[sc0\-g\-data var=`(.*?)`\](.*?)\[\/sc0\-g\-data\]/', $responceContent, $matches2, PREG_SET_ORDER);
        if (!empty($matches2) and !empty($routeParameters)) {
          foreach ($matches2 as $key => $value) {


            $Attr = Entity::ShowAttributeTypes();

            $DataShowRelSig = $value[1];

            $DataShowID = Data::ShowID($routeParameters, $DataShowRelSig);
            $DataValues = Data::Show($DataShowID);

            // $result = $DataShowID;
            $result = $DataValues[$Attr[2]];

            $responceContent = str_replace($value[0], $result, $responceContent);
          }
        }

        return $responceContent;
      }


      function foreach_structurer($responceContent, $routeParameters)
      {
        if (!function_exists('App\Http\Middleware\iterations')) {
          function  iterations($result,$EntityShowMulti,$value,$responceContent,$routeParameters){
            // $preg_match_all = "/\[s type=`foreach` var=`\[g type=`foreach`\]Book\[\/g\]` level=`1`\]((.|\r\n)*?)\[\/s type=`foreach` var=`value` level=`1`\]/";
            // $preg_match_all = "/\[s type=`foreach` var=`\[g type=`foreach`\]Book\/Chapter 1\/Dialogue set 1\[\/g\]` level=`1`\]((.|\r\n)*?)\[\/s type=`foreach` var=`\[g type=`foreach`\]Book\/Chapter 1\/Dialogue set 1\[\/g\]` level=`1`\]/";
            // $preg_match_all = "/\[sc0\-s\-foreach type=`foreach` var=`\[g type=`foreach`\](.*?)\[\/g\]` level=`1`\]((.|\r\n)*?)\[\/sc0\-s\-foreach type=`foreach` var=`(.*?)` level=`1`\]/";
            $preg_match_all = "/\[sc0\-s\-foreach var=`(.*?)`\]((.|\r\n)*?)\[\/sc0\-s\-foreach\]/";

            preg_match_all($preg_match_all, $responceContent, $matches, PREG_SET_ORDER);
            // dd($matches);
            if (!empty($matches)) {
              foreach ($matches as $key => $value) {
                if ($EntityShowMulti==null) {
                  $DataShowRelSig = $value[1];
                  $DataShowID = Data::ShowID($routeParameters, $DataShowRelSig);

                  $BaseEntityID = $DataShowID;
                  $BaseEntityType = 'Data';
                  $EntityType = 'Data';
                  $Slug = null;

                  $EntityShowMulti = Entity::ShowMulti($BaseEntityType,$BaseEntityID, $EntityType,$Slug);
                }


                // $DataShowName = explode('/',$DataShowRelSig);
                // $DataShowName = end($DataShowName);
                // $DataShowName = base64_encode($DataShowName);



                foreach (reset($EntityShowMulti)['content'] as $key => $value2) {

                  // $echome = $value2;
                  // $echome = reset($echome['content']);
                  // echo $echome['content'].'<br>';

                  $pattern = '/\[sc1-s-foreach-g var=`(.*?)`\](.*?)\[\/sc1-s-foreach-g\]/';
                  preg_match_all($pattern, $value[2], $matches2, PREG_SET_ORDER);

                  if (!empty($matches2)) {
                    dd($matches2);
                    foreach ($matches2 as $key => $value3) {
                      // dd($value3[0]);


                      $DataShowName2 = base64_encode($value3[1]);

                      $result4 =  $value2['content'][$DataShowName2]['content'].'<br>';
                      // $supercala = 'value';
                      // $$supercala[2] = str_replace($value3[0], $result4, $value[2]);
                      $value[2] = str_replace($value3[0], $result4, $value[2]);
                    }
                    $result = $result.$value[2];
                  } else {

                    $result = iterations($result,$EntityShowMulti,$value,$responceContent,$routeParameters);
                  }
                }
                // $result = $result.iterations($result,$EntityShowMulti,$value,$responceContent,$routeParameters);
                $responceContent = str_replace($value[0], $result, $responceContent);
                // return $result;
              }
            }
            return $responceContent;
          }
        }
        $EntityShowMulti = null;
        $value = null;
        $result = null;
        $responceContent = iterations($result,$EntityShowMulti,$value,$responceContent,$routeParameters);

        return $responceContent;
      }

      function shortcode($responceContent,$routeParameters){

        $preg_match_all = '/\[sc(.*?)-(.*?) var=`(.*?)`\]((.|\n)*?)\[\/sc\1-\2\]/';

        preg_match_all($preg_match_all, $responceContent, $matches, PREG_SET_ORDER);
        // dd($matches);
        if (!empty($matches)) {
          $responceContentNew = $responceContent;

          $responceContentNew = menu_getter($responceContentNew, $routeParameters);

          $responceContentNew = data_getter($responceContentNew, $routeParameters);
          $responceContentNew = foreach_structurer($responceContentNew, $routeParameters);


          foreach ($matches as $key => $value) {

            if ($value[1] > 0) {
              $replace = $value[1] -1;
              $responceContentNew = str_replace($value[0], '[sc'.$replace.'-'.$value[2].' var=`'.$value[3].'`]'.$value[4].'[/sc'.$replace.'-'.$value[2].']', $responceContentNew);
            } else {
              $responceContentNew = str_replace($value[0], 'error - unknown shortcode', $responceContentNew);

            }
          }


          $responceContentNew = shortcode($responceContentNew, $routeParameters);

          $responceContent = $responceContentNew;


        }

        return $responceContent;
      }


      // $responceContent = $responce;

      $responceContent = $responce->content();


      $responceContent = shortcode($responceContent, $routeParameters);


      $responce->setContent($responceContent);

      return $responce;
    }
  }
}
