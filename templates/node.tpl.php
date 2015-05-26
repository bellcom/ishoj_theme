<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>


<?php

$output = "";
?>

                     
        <!-- ARTIKEL START -->
<?php       
        // Hvis node-typen er "aktivitet"
        if($node->type == 'aktivitet') {
          $output = $output . "<section id=\"node-" . $node->nid . "\" class=\"" . $classes . " artikel activities aktivitet-node\">";
        }
        elseif($node->field_indholdstype) {
          // Hvis kriseinformation 
          if(taxonomy_term_load($node->field_indholdstype['und'][0]['tid'])->name == "Kriseinformation") {
            $output = $output . "<section id=\"node-" . $node->nid . "\" class=\"" . $classes . " artikel breaking-artikel\">";
          }
          else {
            $output = $output . "<section id=\"node-" . $node->nid . "\" class=\"" . $classes . " artikel\">";
          }
        }
        else {
          $output = $output . "<section id=\"node-" . $node->nid . "\" class=\"" . $classes . " artikel\">";
        }

         
          $output = $output . "<div class=\"container\">";
 // 




             // Brødkrummesti
            $output = $output . "<div class=\"row\">";
              $output = $output . "<div class=\"grid-two-thirds\">";
              // $output = $output . "<p class=\"breadcrumbs\">" . theme('breadcrumb', array('breadcrumb'=>drupal_get_breadcrumb())) . " / " .  "<a href=\"" . url('taxonomy/term/' . $bterm->tid) . "\" title=\"Kategorien " . "</a>" . " / " . $title . "</p>";
              $output = $output . "</div>";
            $output = $output . "</div>";

           
            $output = $output . "<div class=\"row second\">";
              $output = $output . "<div class=\"grid-two-thirds\">";
                
              

                // HVIS NODE-TYPEN ER "AKTIVITET"
                if($node->type == 'aktivitet') {

                  $output = $output . "<ul>";
                    $output = $output . "<li>";
                      // Dato
                      if($node->field_aktivitetsdato) {
                        $output = $output . "<div class=\"date\">" . format_date($node->field_aktivitetsdato['und'][0]['value'], 'dato_uden_aar') . "</div>";
                      }
                      $output = $output . "<div class=\"circle\">";
                        $output = $output . "<div></div>";
                      $output = $output . "</div>";
                    $output = $output . "</li>";
                  $output = $output . "</ul>";
                }
                // ALLE ANDRE NODE-TYPER
                else {
                  $output = $output . "<h1>" . $title . "</h1>";
                }

                
              $output = $output . "</div>";
              $output = $output . "<div class=\"grid-third sociale-medier social-desktop\"></div>";
            $output = $output . "</div>";
  
            $output = $output . "<div class=\"row second\">";
              $output = $output . "<div class=\"grid-two-thirds\">";
                $output = $output . "<!-- ARTIKEL TOP START -->";
                $output = $output . "<div class=\"artikel-top\">";
                  // HVIS NODE-TYPEN ER "AKTIVITET"
                  if($node->type == 'aktivitet') {
                    if($node->field_os2web_base_field_image) {
                      $output = $output . "<div class=\"description med-foto\">";
                      // $node->field_os2web_base_field_image['und'][0]['uri']
 
                    }
                    else {
                      $output = $output . "<div class=\"description\">";
                    }
                  }
                    // FOTO
                    $output = $output . "<!-- FOTO START -->";
                    
                    if($node->field_os2web_base_field_image) {
                      hide($content['field_image_flexslider']);
                      $output = $output . render($content['field_os2web_base_field_image']);
                      if($node->field_billedtekst) {
                        $output = $output . "<p class=\"foto-tekst\">" . $node->field_billedtekst['und'][0]['value'] . "</p>";
                      }
                    }
                    $output = $output . "<!-- FOTO SLUT -->";

                    // FLEXSLIDER
                    $output = $output . "<!-- FLEXSLIDER START -->";
                    if(($node->field_image_flexslider) and (!$node->field_os2web_base_field_image)) {
  //                  if(($node->field_image_flexslider)) {
                      $output = $output . "<div class=\"flexslider\">";
                        $output = $output . "<ul class=\"slides\">";

                        $length = sizeof($node->field_image_flexslider['und']);
                        for ($i = 0; $i < $length; $i++) {
                          $output = $output . "<li>" . render($content['field_image_flexslider'][$i]) . "</li>"; 
                        }
  //                      print render($content['field_image_flexslider'][1]);
  //                      print render($content['field_image_flexslider'][0]);
                        $output = $output . "</ul>";                  
                      $output = $output . "</div>";
                    }
                    $output = $output . "<!-- FLEXSLIDER SLUT -->";

                    // VIDEO
                    $output = $output . "<!-- VIDEO START -->";
                    if(($node->field_video) and (!$node->field_os2web_base_field_image) and (!$node->field_image_flexslider)) {
                      $output = $output . "<div class=\"video-indlejret\">";
                        $output = $output . "<div class=\"embed-container vimeo\">";
                          $output = $output . $node->field_video['und'][0]['value'];
                        $output = $output . "</div>";
                      $output = $output . "</div>";
                      if ($node->field_videotekst) {
                        $output = $output . "<p class=\"video-tekst\">" . $node->field_videotekst['und'][0]['value'] . "</p>";
                      }
                    }
                    $output = $output . "<!-- VIDEO SLUT -->";
                 
                    // HVIS NODE-TYPEN ER "AKTIVITET"
                    if($node->type == 'aktivitet') {
                      // Overskrift
                      if($node->field_os2web_base_field_image) {
                        $output = $output . "<h1 class=\"med-foto\">" . $title . "</h1>";
                      }
                      else {
                        $output = $output . "<h1>" . $title . "</h1>";
                      }
                      // Beskrivelse
                      if($node->body) {
                        $output = $output . $node->body['und'][0]['value'];
                      }
                      // Kategori
                      if($node->field_aktivitetstype) {
                        $output = $output . "<p class=\"category\">";
                        $output = $output . "<strong>Kategori:</strong> ";
                        $i = 0;
                          foreach ($node->field_aktivitetstype['und'] as $term) {
                             if($i == 0) {
                                $output = $output . "<a href=\"" . url('taxonomy/term/' . $term['tid']) . "\" title=\"Aktiviteter under kategorien " . taxonomy_term_load($term['tid'])->name . "\">" . taxonomy_term_load($term['tid'])->name . "</a>";
                             }
                             else {
                                $output = $output . ", <a href=\"" . url('taxonomy/term/' . $term['tid']) . "\" title=\"Aktiviteter under kategorien " . taxonomy_term_load($term['tid'])->name . "\">" . taxonomy_term_load($term['tid'])->name . "</a>";
                             }
                             $i = $i + 1;
                          }
                        $output = $output . "</p>";
                      }                      
                      // Dato
                      if($node->field_aktivitetsdato) {
                        $output = $output . "<p><span><strong>Dato:</strong></span> " . format_date($node->field_aktivitetsdato['und'][0]['value'], 'senest_redigeret');
                        if(($node->field_aktivitetsdato['und'][0]['value2']) and (format_date($node->field_aktivitetsdato['und'][0]['value'], 'senest_redigeret') != format_date($node->field_aktivitetsdato['und'][0]['value2'], 'senest_redigeret'))) {
                          $output = $output . " - " . format_date($node->field_aktivitetsdato['und'][0]['value2'], 'senest_redigeret');
                        }
                        $output = $output . "</p>";
                      }
                      // Tid
                      if($node->field_aktivitetsdato) {
                        $output = $output . "<p><span><strong>Tid:</strong></span> " . format_date($node->field_aktivitetsdato['und'][0]['value'], 'klokkeslaet');
                        if(($node->field_aktivitetsdato['und'][0]['value2']) and (format_date($node->field_aktivitetsdato['und'][0]['value'], 'klokkeslaet') != format_date($node->field_aktivitetsdato['und'][0]['value2'], 'klokkeslaet'))) {
                          $output = $output . " - " . format_date($node->field_aktivitetsdato['und'][0]['value2'], 'klokkeslaet');
                        }
                        $output = $output . "</p>";
                      }
                      // Aktivitetssted
                      if($node->field_aktivitetssted) {
                         $output = $output . "<p><span><strong>Sted:</strong></span> <a href=\"" . url('taxonomy/term/' . $node->field_aktivitetssted['und'][0]['tid']) . "\" title=\"Aktiviteter i " . taxonomy_term_load($node->field_aktivitetssted['und'][0]['tid'])->name . "\">" . taxonomy_term_load($node->field_aktivitetssted['und'][0]['tid'])->name . "</a></p>";
                      }
                      // Deltagerbetaling
                      if($node->field_betaling_for_aktivitet){
                        if(taxonomy_term_load($node->field_betaling_for_aktivitet['und'][0]['tid'])->name == "Deltagerbetaling") {
                          if($node->field_pris) {
                            $output .= "<p><span><strong>Pris: </strong></span>" . $node->field_pris['und'][0]['value'] . "</p>";
                          }
                        }
                        else {
                         $output = $output . "<p>" . taxonomy_term_load($node->field_betaling_for_aktivitet['und'][0]['tid'])->name . "</p>";
                        }
                      }
                      
                      // Hjemmeside
                      if($node->field_hjemmeside) {
                        $output .= "<p><span><strong>Mere info: </strong></span><a href=\"//" . $node->field_hjemmeside['und'][0]['value'] . "\" title=\"Mere info på " . $node->field_hjemmeside['und'][0]['value'] . "\">" . $node->field_hjemmeside['und'][0]['value'] . "</a></p>";
                      }
                      
                      // Arrangør
                      if($node->field_arrangor) {
                        $output .= "<p><span><strong>Arrangør: </strong></span>" . taxonomy_term_load($node->field_arrangor['und'][0]['tid'])->name . "</a></p>";
                      }
                      
                     $output = $output . "</div>";
                    }

                $output = $output . "</div>";
                $output = $output . "<!-- ARTIKEL TOP SLUT -->";
                
                // UNDEROVERSKRIFT
                $output = $output . "<!-- UNDEROVERSKRIFT START -->";
                if($node->field_os2web_base_field_summary) {
                  $output = $output . "<h2>" . $node->field_os2web_base_field_summary['und'][0]['safe_value'] . "</h2>";
                }
                $output = $output . "<!-- UNDEROVERSKRIFT SLUT -->";
               
                // SELVBETJENINGSLØSNING
                $output = $output . "<!-- SELBETJENINGSLØSNING START -->";
                $output = $output . views_embed_view('selvbetjeningslosning','default', $node->nid);
                $output = $output . "<!-- SELBETJENINGSLØSNING SLUT -->";
               
                
                // TEKSTINDHOLD
                $output = $output . "<!-- TEKSTINDHOLD START -->";
                hide($content['comments']);
                hide($content['links']);
                $output = $output . render($content);
                $output = $output . "<!-- TEKSTINDHOLD SLUT -->";
                
                
                // MIKROARTIKLER
                $output = $output . "<!-- MIKROARTIKLER START -->";
                if($node->field_mikroartikler_titel1 or 
                  $node->field_mikroartikler_titel2 or 
                  $node->field_mikroartikler_titel3 or 
                  $node->field_mikroartikler_titel4 or 
                  $node->field_mikroartikler_titel5 or 
                  $node->field_mikroartikler_titel6 or 
                  $node->field_mikroartikler_titel7 or 
                  $node->field_mikroartikler_titel8 or 
                  $node->field_mikroartikler_titel9 or 
                  $node->field_mikroartikler_titel10) {

                  $mikroartikel = '<div class="microArticleContainer">';

                  if($node->field_mikroartikler_titel1) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle1"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel1['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle1 mArticle">' . $node->field_mikroartikler_tekst1['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel2) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle2"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel2['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle2 mArticle">' . $node->field_mikroartikler_tekst2['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel3) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle3"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel3['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle3 mArticle">' . $node->field_mikroartikler_tekst3['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel4) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle4"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel4['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle4 mArticle">' . $node->field_mikroartikler_tekst4['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel5) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle5"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel5['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle5 mArticle">' . $node->field_mikroartikler_tekst5['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel6) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle6"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel6['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle6 mArticle">' . $node->field_mikroartikler_tekst6['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel7) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle7"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel7['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle7 mArticle">' . $node->field_mikroartikler_tekst7['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel8) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle8"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel8['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle8 mArticle">' . $node->field_mikroartikler_tekst8['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel9) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle9"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel9['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle9 mArticle">' . $node->field_mikroartikler_tekst9['und'][0]['safe_value'] . '</div></div>';
                  }

                  if($node->field_mikroartikler_titel10) {
                    $mikroartikel = $mikroartikel . '<div class="microArticle"><h2 class="mArticle" id="mArticle10"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel10['und'][0]['safe_value'] . '</h2>';
                    $mikroartikel = $mikroartikel . '<div class="mArticle10 mArticle">' . $node->field_mikroartikler_tekst10['und'][0]['safe_value'] . '</div></div>';
                  }

                  $mikroartikel = $mikroartikel . "</div>";
                  $output = $output . $mikroartikel;	
                }
                $output = $output . "<!-- MIKROARTIKLER SLUT -->";


                // ------------------------------------------------- //
                //  S P E C I F I K K E   I N D H O L D S T Y P E R  //
                // ------------------------------------------------- //


                // Hvis indholdstypen er en ledig stilling 
                if(taxonomy_term_load($node->field_indholdstype['und'][0]['tid'])->name == "Ledig stilling") {
                  $output .= "<div class=\"artikel-boks\"><p>Ishøj Kommune ønsker at afspejle samfundet. Derfor opfordres kvinder og mænd uanset alder, religion, handicap og etnisk baggrund til at søge.</p></div>";
                }



                if($node->field_indholdstype) {
                  
                  // Hvis det ikke er af typen kriseinformation 
                  if(taxonomy_term_load($node->field_indholdstype['und'][0]['tid'])->name <> "Kriseinformation") {
                                                    
                    // DIVERSE BOKS
                    $output = $output . "<!-- DIVERSE BOKS START -->";
                    if($node->field_diverse_boks) {
                      $output = $output . "<div class=\"diverse-boks\">";
                      $output = $output . $node->field_diverse_boks['und'][0]['safe_value'];
                      $output = $output . "</div>";
                    }
                    $output = $output . "<!-- DIVERSE BOKS SLUT -->";
                  }
                }
                
                
                // LÆS OGSÅ
                $output = $output . "<!-- LÆS OGSÅ START -->";
                if($node->field_url) {
                  if($node->field_diverse_boks) {
                    $output = $output . "<hr>";
                  }
                  $output = $output . "<h2>Læs også</h2>";
                  $output = $output . "<ul>";
                  foreach ($node->field_url['und'] as $value) {
                    $output = $output . "<li>";
                      $output = $output . "<a href=\"" . $value['url'] . "\" title=\"" . $value['title'] . "\">";
                        $output = $output . $value['title'];
                      $output = $output . "</a>";
                    $output = $output . "</li>";
                  }
                  $output = $output . "</ul>";
                }
                $output = $output . "<!-- LÆS OGSÅ SLUT -->";


                // HVAD SIGER LOVEN?
                $output = $output . "<!-- HVAD SIGER LOVEN? START -->";
                if($node->field_url_2) {
                  if(($node->field_url) or ($node->field_diverse_boks)) {
                    $output = $output . "<hr>";
                  }
                  $output = $output . "<h2>Hvad siger loven?</h2>";
                  $output = $output . "<ul>";
                  foreach ($node->field_url_2['und'] as $value) {
                    $output = $output . "<li>";
                      $output = $output . "<a href=\"" . $value['url'] . "\" title=\"" . $value['title'] . "\">";
                        $output = $output . $value['title'];
                      $output = $output . "</a>";
                    $output = $output . "</li>";
                  }
                  $output = $output . "</ul>";
                }
                $output = $output . "<!-- HVAD SIGER LOVEN? SLUT -->";
                
                
                // KONTAKT
                $output = $output . "<!-- KONTAKT START -->";
                
                  if(($node->field_url) or ($node->field_url_2) or ($node->field_diverse_boks)) {
                    $output = $output . "<hr>";
                  }
                  $output = $output . "<h2>Kontakt</h2>";
                  $output = $output . views_embed_view('kontakt_kle','default', $node->field_os2web_base_field_kle_ref['und'][0][tid]);
                  $output = $output . "<!-- GOOGLE MAP START -->";
                  $output = $output . "<div id=\"map-canvas\"></div>";
                  $output = $output . "<button class=\"btn map-btn\" onclick=\"loadMapScript();\">Vis kort</button>";
                  $output = $output . "<!-- GOOGLE MAP SLUT -->";
                
                $output = $output . "<!-- KONTAKT SLUT -->";


                // DEL PÅ SOCIALE MEDIER
                // Hvis noden er en indholdsside, borger.dk-artikel eller en aktivitet 
                if(($node->type == 'os2web_base_contentpage') or ($node->type == 'os2web_borger_dk_article') or ($node->type == 'aktivitet')) {
                  include_once drupal_get_path('theme', 'ishoj') . '/includes/del-paa-sociale-medier.php';
                }

                
                // SENEST OPDATERET
                $output = $output . "<!-- SENEST OPDATERET START -->";
                $output = $output . "<p class=\"last-updated\">Senest opdateret " . format_date($node->changed, 'senest_redigeret') . "</p>";
                $output = $output . "<!-- SENEST OPDATERET SLUT -->";
                

                // REDIGÉR-KNAP
                if($logged_in) {
                  $output .= "<div class=\"edit-node\"><a href=\"/node/" . $node->nid . "/edit?destination=admin/content\" title=\"Ret indhold\"><span>Ret indhold</span></a></div>";
                }


                $output = $output . "</div>";
              
              
              // HVIS NODEN ER AF TYPEN INDHOLD, BORGER.DK-ARTIKEL ELLER AKTIVITET 
              if(($node->type == 'os2web_base_contentpage') or ($node->type == 'os2web_borger_dk_article') or ($node->type == 'aktivitet')) {
                
                $output = $output . "<div class=\"grid-third\">";
                
                
                // HVIS DER ER VALGT EN INDHOLDSTYPE VED "OPRET INDHOLD"
                if($node->field_indholdstype) {
                  
                  // Hvis indholdstypen er Nyhed
                  if(taxonomy_term_load($node->field_indholdstype['und'][0]['tid'])->name == "Nyhed") {
                    // LISTE OVER NYHEDER START
                    $output = $output . "<nav class=\"menu-underside\">";
                      $output = $output . "<ul class=\"menu\">";
                        $output = $output . "<li class=\"first expanded active-trail\">";
//                          $output .= "<h2>Andre nyheder</h2>";
                          $output = $output . "<ul class=\"menu\">";
                            $output = $output . views_embed_view('nyhedsliste','panel_pane_1', $node->nid);
                          $output = $output . "</ul>";
                        $output = $output . "</li>";
                      $output = $output . "</ul>";
                    $output = $output . "</nav>";
                  }
                  // LISTE OVER NYHEDER SLUT
                  
                  // Hvis indholdstypen er en kriseinformation 
                  elseif(taxonomy_term_load($node->field_indholdstype['und'][0]['tid'])->name == "Kriseinformation") {
                    // DIVERSE BOKS
                    $output = $output . "<!-- DIVERSE BOKS START -->";
                    if($node->field_diverse_boks) {
                      $output = $output . "<div class=\"diverse-boks\">";
                      $output = $output . $node->field_diverse_boks['und'][0]['safe_value'];
                      $output = $output . "</div>";
                    }
                    $output = $output . "<!-- DIVERSE BOKS SLUT -->";
                  }

                  // Hvis indholdstypen er en ledig stilling 
                  if(taxonomy_term_load($node->field_indholdstype['und'][0]['tid'])->name == "Ledig stilling") {
                    // LISTE OVER LEDIGE STILLINGER START
                    $output = $output . "<nav class=\"menu-underside\">";
                      $output = $output . "<ul class=\"menu\">";
                        $output = $output . "<li class=\"first expanded active-trail\">";
                          $output = $output . "<ul class=\"menu\">";
                            $output = $output . views_embed_view('ledig_stilling','ledige_stillinger_liste_minus_viste_node', $node->nid);
                          $output = $output . "</ul>";
                        $output = $output . "</li>";
                      $output = $output . "</ul>";
                    $output = $output . "</nav>";
                  }
                  // LISTE OVER LEDIGE STILLINGER SLUT

                  else {
                    
                    
                    
                    // MENU TIL UNDERSIDER START
                    $output = $output . "<nav class=\"menu-underside\">";
                 

 // til BLOCK MENU SITES
  $block = module_invoke('menu_block', 'block_view', '4');
  $output.= render($block['content']);

                    $output = $output . "</nav>";
                    // MENU TIL UNDERSIDER SLUT
                  }
                }
                

                $output = $output . "</div>";
              
              }
              
            $output = $output . "</div>";
          $output = $output . "</div>";
        $output = $output . "</section>";
        $output = $output . "<!-- ARTIKEL SLUT -->";

       
        // DIMMER DEL SIDEN
        $output = $output . "<!-- DIMMER DEL SIDEN START -->";
        // OPRET DEL-PÅ-SOCIALE-MEDIER-KNAPPER, 
        // HVIS NODEN ER AF TYPEN INDHOLD, BORGER.DK-ARTIKEL ELLER AKTIVITET 
        if(($node->type == 'os2web_base_contentpage') or ($node->type == 'os2web_borger_dk_article') or ($node->type == 'aktivitet')) {
          $options = array('absolute' => TRUE);
          $nid = $node->nid; // Node ID
          $abs_url = url('node/' . $nid, $options);

          $output = $output . "<div class=\"dimmer-delsiden hidden\">";
          
          $output .= "<a class=\"breaking-close\" href=\"#\" title=\"Luk\"></a>";
            
            $output = $output . "<ul>";
              $output = $output . "<li class=\"sociale-medier\"><a class=\"sprite sprite-facebook\" href=\"https://www.facebook.com/sharer/sharer.php?u=" . $abs_url . "\" title=\"Del siden på Facebook\"><span><span class=\"screen-reader\">Del siden på Facebook</span></span></a></li>";
              $output = $output . "<li class=\"sociale-medier\"><a class=\"sprite sprite-twitter\" href=\"https://twitter.com/home?status=" . $title . " " . $abs_url . "\" title=\"Del siden på Twitter\"><span><span class=\"screen-reader\">Del siden på Twitter</span></span></a></li>";
              $output = $output . "<li class=\"sociale-medier\"><a class=\"sprite sprite-googleplus\" href=\"https://plus.google.com/share?url=" . $abs_url . "\" title=\"Del siden på Google+\"><span><span class=\"screen-reader\">Del siden på Google+</span></span></a></li>";
              $output = $output . "<li class=\"sociale-medier\"><a class=\"sprite sprite-linkedin\" href=\"https://www.linkedin.com/shareArticle?url=" . $abs_url . "&title=" . $title . "&summary=&source=&mini=true\" title=\"Del siden på LinkedIn\"><span><span class=\"screen-reader\">Del siden på LinkedIn</span></span></a></li>";          
              $output = $output . "<li class=\"sociale-medier\"><a class=\"sprite sprite-mail\" href=\"mailto:?subject=" . $title . " title=\"Send som e-mail\"><span><span class=\"screen-reader\">Send som e-mail</span></span></a></li>";          
              $output = $output . "<li class=\"sociale-medier\"><a class=\"sprite sprite-link\" href=\"#\" title=\"Del link\"><span><span class=\"screen-reader\">Del link</span></span></a></li>";          
            $output = $output . "</ul>";
            $output = $output . "<div class=\"link-url\">";
              $output = $output . "<textarea>" . $abs_url . "</textarea>";
            $output = $output . "</div>";
          $output = $output . "</div>";
        }
        $output = $output . "<!-- DIMMER DEL SIDEN SLUT -->";

          // BREAKING
          $output .= views_embed_view('kriseinformation','nodevisning', $node->nid);

//        $output = $output . "<!-- BREAKING START -->";
//        $output = $output . "<div class=\"breaking\">";
//          $output = $output . "<div class=\"container\">";
//            $output = $output . "<div class=\"row\">";
//              $output = $output . "<div class=\"grid-full\">";
//                $output = $output . "<div class=\"breaking-inner\">";
//                  $output = $output . "<a class=\"breaking-close\" href=\"#\" title=\"Luk\"></a>";
//                  $output = $output . "<h2><a href=\"#\" title=\"BREAKING: Ishøj Bycenter under vand....stik af!\">BREAKING: Ishøj Bycenter under vand....stik af!</a></h2>";                
//                $output = $output . "</div>";
//              $output = $output . "</div>";
//            $output = $output . "</div>";
//          $output = $output . "</div>";
//        $output = $output . "</div>";
//        $output = $output . "<!-- BREAKING SLUT -->"; 

        print $output;
        print render($content['links']);
        print render($content['comments']); 


?>

       

