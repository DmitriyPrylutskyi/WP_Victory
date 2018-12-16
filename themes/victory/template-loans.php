<?php
/* Template Name: Loans Template */

get_header();

$phone = get_option('phone_options');

//terms
$terms = '';

if( have_rows('terms') ):
    while ( have_rows('terms') ) : the_row();

    	$term = get_sub_field('term');

    	if ( stristr($term, 'phone') ) {
    		$term = str_replace("phone", "<a href='tel://$phone'>$phone</a>", $term);
    	}

    	$terms .= '<li>';
    	$terms .= '<div>';
    	$terms .= $term;
    	$terms .= '</div>';
    	$terms .= '</li>';

    endwhile;
endif;

?>

<div class="loans-ar">
    <div class="oun-head">
        <h2>
            <?php echo get_the_title(); ?>
        </h2>
    </div>
    <div class="loans-wrapp">
        <div class="block-with-back-or">
            <ol>
                <?php echo $terms; ?>
                <div class="clean"></div>
            </ol>
        </div>
        <div class="clean"></div>
        <div class="text-info-only">
            <a href="" data-toggle="modal" data-target="#make-request" class="make-request">Оставить заявку</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
