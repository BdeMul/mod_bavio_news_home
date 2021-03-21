<?php 
defined('_JEXEC') or die;

use Joomla\CMS\Categories\Categories;
$categories = Categories::getInstance('content');

?>

<div class="event-section section position-relative section-padding">
    <div class="container">
        <!-- Section Title Start -->
        <div class="section-title text-center" data-aos="fade-up">
            <span class="sub-title"><?php echo($sub_title) ?></span>
            <h2 class="title fz-48"><?php echo($title) ?></h2>
        </div>
        <!-- Section Title End -->

        <div class="row row-cols-lg-2 row-cols-1 max-mb-n30">
            <?php 
            foreach($articles as $article): 
                $lang = array();
                $lang['en'] = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
                $lang['nl'] = ['Jan','Feb','Mrt','Apr','Mei','Juni','Juli','Aug','Sep','Okt','Nov','Dec'];
        
                $creationDate = DateTime::createFromFormat('Y-m-d H:i:s', $article->created);
            ?>
            <div class="col max-mb-30" data-aos="fade-up">
                <div class="event-list-box">
                    <div class="event-caption">
                        <div class="left-box">
                            <div class="event-location">
                                <i class="fas fa-at"></i>
                                <?php echo(JFactory::getUser($article->created_by)->name) ?>
                                <i style="margin-left: 10px;" class="fad fa-folder-tree"></i>
                                <?php echo( $categories->get($article->catid)->title) ?>
                                <i style="margin-left: 10px;" class="fad fa-eye"></i>
                                <?php echo($article->hits) ?>
                            </div>
                            <h3 class="title"><?php echo($article->title) ?></h3>
                        </div>
                        <div class="right-box">
                            <div class="event-date">
                                <div class="event-date-day"><?php echo($creationDate->format('j')) ?></div>
                                <div class="event-date-month">
                                    <?php echo(ucfirst(str_replace($lang['en'], $lang['nl'], $creationDate->format('M')))) ?>
                                </div>
                            </div>
                            <div class="event-button">
                                <a class="btn btn-primary btn-hover-secondary btn-xs"
                                    href="<?php echo(JRoute::_(ContentHelperRoute::getArticleRoute($article->id, $article->catid, $article->language))) ?>">Lees
                                    meer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

        <div class="row max-mt-70">
            <div class="text-center col-lg-7 mx-auto">
                <a class="link link-lg" href="<?php echo($menu_item->path) ?>"><?php echo($read_more) ?>
                    <mark><?php echo($url_text) ?> <i class="far fa-long-arrow-right"></i></mark></a>
            </div>
        </div>


    </div>

    <!-- Section Bottom Shape Start -->
    <div class="section-bottom-shape-two">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" height="315">
            <path class="elementor-shape-fill" d="M 50 0 S75 0 100 100 L100 0"></path>
        </svg>
    </div>
    <!-- Section Bottom Shape End -->
</div>