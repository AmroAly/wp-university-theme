
    <?php get_header(); ?>
    <h1>This is a page</h1>
    <?php
        while(have_posts()) {
            the_post();
    ?>
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <p><?php the_content(); ?></p>
    <hr>
    <?php
        }
        get_footer();
    ?>
</body>
</html>