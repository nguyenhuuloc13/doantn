<?php get_header(); ?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
<div class="main-content"style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/build.png') bottom no-repeat;">
  <div class="page-content mt-4">
    <div class="container">
      <?php get_template_part('slider'); ?>
      <!-- end row -->
      <div class="row">
        <div class="col-12">
          <div class="alert alert-success" role="alert">
            <h5 class="mb-0">Sản Phẩm Nổi Bật <i class="mdi mdi-heart text-danger"></i></h5>
          </div>
        </div>
      </div>
      <div class="row">
        <?php
            $tax_query[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
          ?>
          <?php $args = array( 'post_type' => 'product','posts_per_page' => 8,'ignore_sticky_posts' => 1, 'tax_query' => $tax_query); ?>
          <?php $getposts = new WP_query( $args);?>
          <?php global $wp_query; $wp_query->in_the_loop = true; ?>
          <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
          <?php global $product; ?>
          <?php  $attr_feature =  wc_get_product_terms( get_the_ID(), 'pa_feature', array( 'fields' => 'names' ) ); ?>
          <div class="col-xl-3 col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="product-img position-relative">
                      <div class="avatar-sm product-ribbon">
                        <ul class="label list-unstyled mb-2">
                            <?php foreach ($attr_feature as $key => $value) { ?>
                            <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-success"><?php echo $value; ?></a></li>
                            <?php } ?>
                        </ul>
                        <?php if ( $product->is_on_sale() && $product->get_regular_price() && $product->get_sale_price()) : ?>
                          <span class="avatar-title rounded-circle  bg-primary">- <?php echo percentSale($product->get_regular_price(), $product->get_sale_price()); ?> %</span>
                        <?php endif; ?>
                      </div>
                      <a href="<?php the_permalink(); ?>"><img style="width:100%;height:auto;;" src="<?php echo esc_url(wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium')[0]); ?>" alt=""></a>
                  </div>
                  <div class="mt-4 text-center">
                      <h5 class="mb-3 text-truncate"><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></h5>
                      <h5 class="my-0"><span class="text-dark me-2"></span> <b><?php echo $product->get_price_html(); ?></b></h5>
                  </div>
              </div>
            </div>
          </div><!--end col-->
          <?php endwhile; wp_reset_postdata(); ?>
      </div><!--end row-->

      <!--new product-->
      <div class="row">
        <div class="col-12">
          <div class="alert alert-success" role="alert">
            <h5 class="mb-0">Sản Phẩm Mới Nhất <i class="mdi mdi-heart text-danger"></i></h5>
          </div>
        </div>
      </div>
      <div class="row">
        <?php
         $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
         $args = array(
                'post_type' => 'product',
                'posts_per_page' => 12,
                'paged' => $paged
              ); ?>

            <?php $getposts = new WP_query( $args);?>
            <?php global $wp_query; $wp_query->in_the_loop = true; ?>
            <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
            <?php global $product; ?>
            <?php $attr_feature =  wc_get_product_terms( get_the_ID(), 'pa_feature', array( 'fields' => 'names' ) ); ?>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="product-img position-relative">
                        <div class="avatar-sm product-ribbon">
                            <ul class="label list-unstyled mb-2">
                                <?php foreach ($attr_feature as $key => $value) { ?>
                                <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-success"><?php echo $value; ?></a></li>
                                <?php } ?>
                            </ul>
                            <?php if ( $product->is_on_sale() && $product->get_regular_price() && $product->get_sale_price()) : ?>
                              <span class="avatar-title rounded-circle  bg-primary">- <?php echo percentSale($product->get_regular_price(), $product->get_sale_price()); ?> %</span>
                            <?php endif; ?>
                        </div>
                        <a href="<?php the_permalink(); ?>"><img style="width:100%;height:auto;;" src="<?php echo esc_url(wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium')[0]); ?>" alt=""></a>
                    </div>
                    <div class="mt-4 text-center">
                        <h5 class="mb-3 text-truncate"><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></h5>
                        <h5 class="my-0"><span class="text-dark me-2"></span> <b><?php echo $product->get_price_html(); ?></b></h5>
                    </div>
                </div>
              </div>
            </div><!--end col-->
          <?php endwhile; wp_reset_postdata(); ?>
          </div>
      </div><!--end col-->
        <!-- end row -->

        <div class="container mt-100 mt-60">
          <div class="alert alert-success" role="alert">
            <div class="row text-left">
                  <div class="col-xl-4">
                      <?php $cat = get_term_by('id', 17, 'product_cat'); ?>
                      <a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="alert-link"> <h5 class="mb-0 text-dark"><?php echo $cat->name; ?> <i class="mdi mdi-heart text-danger"></i></h5></a>
                  </div>
                  <div class="col-xl-8">
                      <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center">
                        <div class="page-title-right">
                           <ol class="breadcrumb m-0">
                              <?php
                              $agrs = array(
                                'type'        => 'product',
                                'child_of'    => 0,
                                'parent'      => 0,
                                'hide_empty'  => 0,
                                'taxonomy'    => 'product_cat',
                                'number'      => 5,
                                'parent'      => $cat->term_id
                              );
                              $categories = get_categories($agrs);
                              foreach ($categories as $category) { ?>
                               <li class="breadcrumb-item"><a href="<?php echo get_term_link($category->slug, 'product_cat'); ?>"><?php echo $category->name; ?></a></li>
                             <?php } ?>
                           </ol>
                       </div>
                      </form>
                  </div>
            </div>
            </div><!--end row-->

            <div class="row">
              <?php $args = array(
                'post_type' => 'product',
                'posts_per_page' => 12,
                'ignore_sticky_posts' => 1,
                'product_cat' => $cat->slug
                ); ?>
              <?php $getposts = new WP_query( $args);?>
              <?php global $wp_query; $wp_query->in_the_loop = true; ?>
              <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
              <?php global $product; ?>
              <?php
               $attr_feature =  wc_get_product_terms( get_the_ID(), 'pa_feature', array( 'fields' => 'names' ) ); ?>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="product-img position-relative">
                            <div class="avatar-sm product-ribbon">
                              <ul class="label list-unstyled mb-2">
                                  <?php foreach ($attr_feature as $key => $value) { ?>
                                  <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-success"><?php echo $value; ?></a></li>
                                  <?php } ?>
                              </ul>
                              <?php if ( $product->is_on_sale() && $product->get_regular_price() && $product->get_sale_price()) : ?>
                                <span class="avatar-title rounded-circle  bg-primary">- <?php echo percentSale($product->get_regular_price(), $product->get_sale_price()); ?> %</span>
                              <?php endif; ?>
                            </div>
                            <a href="<?php the_permalink(); ?>"><img style="width:100%;height:auto;" src="<?php echo esc_url(wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium')[0]); ?>" alt=""></a>
                        </div>
                        <div class="mt-4 text-center">
                            <h5 class="mb-3 text-truncate"><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></h5>
                            <h5 class="my-0"><span class="text-dark me-2"></span> <b><?php echo $product->get_price_html(); ?></b></h5>
                        </div>
                    </div>
                  </div>
                </div><!--end col-->
              <?php endwhile; wp_reset_postdata(); ?>
            </div><!--end row-->

        </div><!--end container-->
    </div> <!-- container-fluid -->
</div>
    <!-- End Page-content -->
<?php get_footer(); ?>
