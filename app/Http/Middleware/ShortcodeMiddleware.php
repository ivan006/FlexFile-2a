<?php

namespace App\Http\Middleware;

use Closure;
use App\GroupM;
use App\PostM;
use App\SmartDataItemM;

use App\Group;
use App\Post;
use App\Data;



class ShortcodeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $responce = $next($request);
        if (!method_exists($responce, "content")) {
          return $responce;
        } else {


          $parameters = $request->route()->parameters();
          $arguments = array_values($parameters);
          if (1==1) {
            // code...
            $responceContent = $responce->content();



            $preg_match_all = "/\[page_list\]((.|\n)*?)\[twig\]((.|\n)*?)\[inner_twig\]((.|\n)*?)\[\/twig\]((.|\n)*?)\[leaf\]((.|\n)*?)\[\/leaf\]((.|\n)*?)\[\/page_list\]/";

            preg_match_all( $preg_match_all, $responceContent, $matches);
            if (!empty($matches[0])) {
              function page_list($VPgsLocs, $value, $preg_match_all){

                foreach($VPgsLocs as $key => $value2){
                  preg_match_all( $preg_match_all, $value, $matches);
                  // echo "<pre>";
                  // var_dump($matches);
                  // echo "</pre>";


                  if (is_array($value2)) {

                    // $preg_match_all = "/\[link\]/";

                    $matches[3][0] = str_replace("[link]", $value2['url'], $matches[3][0]);
                    $matches[3][0] = str_replace("[name]", $key, $matches[3][0]);

                    echo  $matches[3][0];
                    // echo  $value2['url'];
                    // echo $key ;
                    page_list($value2, $value, $preg_match_all);
                    echo  $matches[5][0];

                  } else {
                    if ($key !== "url") {

                      // echo  $value2;
                      // echo $key;
                      $matches[9][0] = str_replace("[name]", $key, $matches[9][0]);
                      $matches[9][0] = str_replace("[link]", $value2, $matches[9][0]);
                      echo  $matches[9][0];
                    }
                  }
                }
              }
              $PostShowSig = Post::ShowSignature($arguments);
              $GroupShowSig = Group::ShowSignature($arguments);
              // dd($arguments);
              // dd($PostShowSig);
              if (!empty($arguments)) {
                // code...
                // dd($arguments);

                $arguments = array_values($arguments);
                $arguments2[0] = $arguments[0];
                foreach ($matches[0] as $key => $value) {
                  // dd($arguments);



                  $VPgsLocs = Post::ShowSubPost($arguments2);
                  // dd($arguments2);
                  // dd($VPgsLocs);
                  ob_start();

                  // if (is_array($VPgsLocs)) {
                    page_list($VPgsLocs,  $value,$preg_match_all);
                  // }

                  $result = ob_get_contents();
                  ob_end_clean();

                  $responceContent = str_replace($value, $result, $responceContent);

                }
                // code  example ..
                // <div class="g-multi-level-dropdown">
                //   <ul>
                //     [page_list]
                //     [twig]
                //     <li>
                //       <a href="[link]">
                //         [name]
                //       </a>
                //       <span class="toggle">
                //       <a href="#">+</a>
                //       <ul>
                //         [inner_twig]
                //       </ul>
                //       </span>
                //     </li>
                //     [/twig]
                //     [leaf]
                //     <li>
                //       <a href="[link]">
                //         [name]
                //       </a>
                //     </li>
                //     [/leaf]
                //     [/page_list]
                //   </ul>
                // </div>
              }

            }
          }


          if (1==1) {
            // code...
            preg_match_all( '/\[r\](.*)\[\/r\]/', $responceContent, $matches2);
            if (!empty($matches2[0])) {

              // dd($matches2);

              foreach ($matches2[0] as $key => $value) {
                // echo $value;
                $shortcode = $value;
                $parameter = str_replace("[r]", "", $shortcode);
                $parameter = str_replace("[/r]", "", $parameter);
                // dd($parameter);
                $Attribute_types = array(
                  '1' => 'SmartDataType',
                  '2' => 'SmartDataContent'
                );


                $PostShowSig = Post::ShowSignature($arguments);
                $GroupShowSig = Group::ShowSignature($arguments);
                $DataShowSig = $parameter;
                // dd($DataShowSig);
                $DataValues = Data::Show($GroupShowSig,$PostShowSig,$DataShowSig);
                $result = $DataValues;
                // dd($result);

                $responceContent = str_replace($shortcode, $result[$Attribute_types[2]], $responceContent);


              }

            }
          }

          $responce->setContent($responceContent);
          return $responce;
        }


    }

}
