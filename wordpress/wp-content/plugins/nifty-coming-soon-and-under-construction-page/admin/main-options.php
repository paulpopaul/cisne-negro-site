<?php

/**
 * Nifty Coming Soon, Maintenance & Under Construction Plugin by Davor Veselinovic
 *
 *
 * Initialize the Nifty ptions panel based on OptionTree
 *
 */

add_action( 'init', 'nifty_cs_custom_theme_options' );
/**
 * Build the custom settings & update OptionTree.
 */

function nifty_cs_custom_theme_options() {

  add_action('admin_action_nifty_dismiss_notice', 'admin_action_dismiss_notice');

  /* OptionTree is not loaded yet7, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;

  /**
   * Get a copy of the saved settings array.
   */

  $saved_settings = get_option( ot_settings_id(), array() );


function admin_action_dismiss_notice() {
  if (empty($_GET['notice'])) {
    wp_safe_redirect(admin_url());
    exit;
  }

  $options = get_option('nifty_options', array());

  if ($_GET['notice'] == 'rate') {
    $options['hide_notice']['rate'] = true;
  } elseif ($_GET['notice'] == 'weforms') {
    $options['hide_notice']['weforms'] = true;
  } else {
    wp_safe_redirect(admin_url());
    exit;
  }

  update_option('nifty_options', $options);

  if (!empty($_GET['redirect'])) {
    wp_safe_redirect($_GET['redirect']);
  } else {
    wp_safe_redirect(admin_url());
  }

  exit;
} // admin_action_dismiss_notice


function ot_type_custom_themes() {
  $themes =

  array (
    0 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Thu, 22 Feb 2018 18:45:00 +0000',
      'name' => 'Aeroplane Company',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'aeroplane-company',
    ),
    1 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 09 Sep 2018 16:06:39 +0000',
      'name' => 'Air Balloon',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'air-balloon',
    ),
    2 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.05',
      'last_edit' => 'Fri, 02 Mar 2018 12:43:04 +0000',
      'name' => 'Animated Clock',
      'description' => 'Andrea',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'animated-clock',
    ),
    3 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 29 May 2019 18:26:27 +0000',
      'name' => 'Architecture INC.',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'architecture-inc',
    ),
    4 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sat, 08 Sep 2018 14:42:03 +0000',
      'name' => 'Architecture',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'architecture',
    ),
    5 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 07 Jul 2019 16:22:50 +0000',
      'name' => 'Art Gallery',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'art-gallery',
    ),
    6 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 23 Sep 2018 12:44:52 +0000',
      'name' => 'Auto Service',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'auto-service',
    ),
    7 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sat, 09 Jun 2018 13:26:02 +0000',
      'name' => 'Beach',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'beach',
    ),
    8 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.05',
      'last_edit' => 'Wed, 28 Feb 2018 10:30:46 +0000',
      'name' => 'Bicycle Race',
      'description' => 'Andrea',
      'frontpage' => '0',
      'status' => 'agency',
      'name_clean' => 'bicycle-race',
    ),
    9 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sat, 23 Mar 2019 14:44:52 +0000',
      'name' => 'Bike Shop',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'bike-shop',
    ),
    10 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Sat, 24 Feb 2018 11:48:50 +0000',
      'name' => 'Bitcoin Miners',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'bitcoin-miners',
    ),
    11 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:50:26 +0000',
      'name' => 'Blogging',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'blogging',
    ),
    12 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 29 May 2019 18:05:04 +0000',
      'name' => 'Blue Ocean',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'blue-ocean',
    ),
    13 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 03 Jul 2019 12:01:57 +0000',
      'name' => 'Body Transformation',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'body-transformation',
    ),
    14 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Tue, 27 Feb 2018 09:56:05 +0000',
      'name' => 'Book Lovers',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'book-lovers',
    ),
    15 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.001',
      'last_edit' => 'Thu, 15 Feb 2018 16:24:58 +0000',
      'name' => 'Business Company',
      'description' => '',
      'frontpage' => '0',
      'status' => 'agency',
      'name_clean' => 'business-company',
    ),
    16 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 16 Jun 2019 20:05:59 +0000',
      'name' => 'Business Meeting (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'business-meeting-video',
    ),
    17 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:06:41 +0000',
      'name' => 'Business',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'business',
    ),
    18 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 30 Jan 2019 19:31:32 +0000',
      'name' => 'Café',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'cafe',
    ),
    19 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 10 Mar 2019 11:24:47 +0000',
      'name' => 'City Nighttime',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'city-nighttime',
    ),
    20 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 29 Jul 2018 12:52:06 +0000',
      'name' => 'Cityscape',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'cityscape',
    ),
    21 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.14',
      'last_edit' => 'Fri, 23 Mar 2018 16:46:05 +0000',
      'name' => 'Clouds Screensaver (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'clouds-screensaver-video',
    ),
    22 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Thu, 22 Feb 2018 18:45:40 +0000',
      'name' => 'Coffee Shop',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'coffee-shop',
    ),
    23 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 04 May 2018 08:57:40 +0000',
      'name' => 'Cold Lake',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'cold-lake',
    ),
    24 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Mon, 07 Jan 2019 08:25:36 +0000',
      'name' => 'Computer Repair Service',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'computer-repair-service',
    ),
    25 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 27 Feb 2019 20:04:27 +0000',
      'name' => 'Concert',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'concert',
    ),
    26 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Tue, 23 Apr 2019 08:43:55 +0000',
      'name' => 'Conference Event',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'conference-event',
    ),
    27 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Nov 2018 10:25:04 +0000',
      'name' => 'Custom Decor',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'custom-decor',
    ),
    28 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Mon, 26 Feb 2018 20:41:31 +0000',
      'name' => 'Default',
      'description' => 'Default settings, nothing more.',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'default',
    ),
    29 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:24:59 +0000',
      'name' => 'Dental Clinic',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'dental-clinic',
    ),
    30 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Mon, 26 Nov 2018 18:41:25 +0000',
      'name' => 'Dog Shelter',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'dog-shelter',
    ),
    31 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.001',
      'last_edit' => 'Tue, 20 Feb 2018 09:14:59 +0000',
      'name' => 'Dog Training and Behavior Consulting',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'dog-training-and-behavior-consulting',
    ),
    32 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Mon, 07 Jan 2019 08:27:22 +0000',
      'name' => 'Employment',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'employment',
    ),
    33 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 23 Dec 2018 09:56:23 +0000',
      'name' => 'Essay Writing Service',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'essay-writing-service',
    ),
    34 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 29 Aug 2018 16:00:04 +0000',
      'name' => 'Fall (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'fall-video',
    ),
    35 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sat, 21 Jul 2018 22:37:09 +0000',
      'name' => 'Fashion',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'fashion',
    ),
    36 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Tue, 30 Oct 2018 18:11:40 +0000',
      'name' => 'Financial District',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'financial-district',
    ),
    37 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.05',
      'last_edit' => 'Fri, 02 Mar 2018 12:33:55 +0000',
      'name' => 'Flower Shop',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'flower-shop',
    ),
    38 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 02 May 2018 09:37:48 +0000',
      'name' => 'Food Blog',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'food-blog',
    ),
    39 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Mon, 18 Jun 2018 16:40:10 +0000',
      'name' => 'Football',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'football',
    ),
    40 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 23 Dec 2018 10:16:53 +0000',
      'name' => 'Frozen Nature',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'frozen-nature',
    ),
    41 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Thu, 28 Feb 2019 08:14:36 +0000',
      'name' => 'Future Technology',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'future-technology',
    ),
    42 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Tue, 23 Oct 2018 17:23:42 +0000',
      'name' => 'Halloween',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'halloween',
    ),
    43 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Tue, 30 Jul 2019 14:26:58 +0000',
      'name' => 'Healthy Eating',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'healthy-eating',
    ),
    44 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sat, 28 Jul 2018 15:16:26 +0000',
      'name' => 'Holiday Resort',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'holiday-resort',
    ),
    45 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:26:42 +0000',
      'name' => 'Homemade Chocolate Gifts',
      'description' => '',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'homemade-chocolate-gifts',
    ),
    46 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 30 Jan 2019 19:33:31 +0000',
      'name' => 'Ice Cream Shop',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'ice-cream-shop',
    ),
    47 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.05',
      'last_edit' => 'Fri, 02 Mar 2018 12:59:44 +0000',
      'name' => 'Interior Design',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'interior-design',
    ),
    48 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.14',
      'last_edit' => 'Fri, 23 Mar 2018 16:42:15 +0000',
      'name' => 'Journey (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'journey-video',
    ),
    49 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Mon, 11 Mar 2019 18:11:04 +0000',
      'name' => 'Ladies Accessories',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'ladies-accessories',
    ),
    50 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:28:28 +0000',
      'name' => 'LEGO Bricks',
      'description' => '',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'lego-bricks',
    ),
    51 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 29 Aug 2018 16:36:44 +0000',
      'name' => 'Loneliness',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'loneliness',
    ),
    52 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:04:55 +0000',
      'name' => 'Lonely Road',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'lonely-road',
    ),
    53 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:30:37 +0000',
      'name' => 'Luxury Car',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'luxury-car',
    ),
    54 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Mon, 26 Feb 2018 18:31:18 +0000',
      'name' => 'Maintenance Mode',
      'description' => 'Andrea',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'maintenance-mode',
    ),
    55 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Mon, 26 Feb 2018 17:59:30 +0000',
      'name' => 'Makeup Artist Training',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'makeup-artist-training',
    ),
    56 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 23 Sep 2018 13:09:03 +0000',
      'name' => 'Misty Forest (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'misty-forest-video',
    ),
    57 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:08:31 +0000',
      'name' => 'Mobile Designer',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'mobile-designer',
    ),
    58 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Tue, 30 Oct 2018 18:10:11 +0000',
      'name' => 'Mobile Meeting',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'mobile-meeting',
    ),
    59 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Mon, 26 Feb 2018 18:04:32 +0000',
      'name' => 'Modern Blog',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'modern-blog',
    ),
    60 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.05',
      'last_edit' => 'Fri, 02 Mar 2018 10:14:21 +0000',
      'name' => 'Modern Office',
      'description' => 'Andrea',
      'frontpage' => '0',
      'status' => 'agency',
      'name_clean' => 'modern-office',
    ),
    61 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Mon, 26 Nov 2018 18:42:35 +0000',
      'name' => 'Modern Recipes',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'modern-recipes',
    ),
    62 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:48:23 +0000',
      'name' => 'Mountain Slide',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'mountain-slide',
    ),
    63 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.05',
      'last_edit' => 'Thu, 01 Mar 2018 10:49:52 +0000',
      'name' => 'Mountain',
      'description' => 'Andrea',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'mountain',
    ),
    64 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:12:56 +0000',
      'name' => 'Movie Trailer (Video)',
      'description' => '',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'movie-trailer-video',
    ),
    65 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 16 Jun 2019 16:57:44 +0000',
      'name' => 'Music',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'music',
    ),
    66 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.05',
      'last_edit' => 'Fri, 02 Mar 2018 10:17:02 +0000',
      'name' => 'Nature',
      'description' => 'Andrea',
      'frontpage' => '0',
      'status' => 'agency',
      'name_clean' => 'nature',
    ),
    67 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.14',
      'last_edit' => 'Fri, 23 Mar 2018 16:37:55 +0000',
      'name' => 'Office Meeting (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'office-meeting-video',
    ),
    68 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.05',
      'last_edit' => 'Fri, 02 Mar 2018 12:35:44 +0000',
      'name' => 'Office Theme',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'office-theme',
    ),
    69 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Mon, 26 Feb 2018 18:07:28 +0000',
      'name' => 'Online Learning',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'online-learning',
    ),
    70 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:10:44 +0000',
      'name' => 'Pancake House',
      'description' => '',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'pancake-house',
    ),
    71 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:15:19 +0000',
      'name' => 'Parenting',
      'description' => '',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'parenting',
    ),
    72 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Tue, 28 Aug 2018 15:03:08 +0000',
      'name' => 'Passage',
      'description' => '',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'passage',
    ),
    73 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Tue, 23 Oct 2018 18:08:17 +0000',
      'name' => 'Peaceful River',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'peaceful-river',
    ),
    74 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sat, 18 May 2019 12:49:23 +0000',
      'name' => 'Personal Trainer',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'personal-trainer',
    ),
    75 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:35:07 +0000',
      'name' => 'Photography',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'photography',
    ),
    76 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 07 Jul 2019 17:17:37 +0000',
      'name' => 'Podcast',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'podcast',
    ),
    77 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 10 Mar 2019 11:20:31 +0000',
      'name' => 'Romantic Travels',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'romantic-travels',
    ),
    78 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:41:09 +0000',
      'name' => 'Running Blog',
      'description' => '',
      'frontpage' => '0',
      'status' => 'agency',
      'name_clean' => 'running-blog',
    ),
    79 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.14',
      'last_edit' => 'Sat, 24 Mar 2018 10:23:40 +0000',
      'name' => 'Running (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'running-video',
    ),
    80 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Thu, 25 Apr 2019 08:11:16 +0000',
      'name' => 'Scholar University',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'scholar-university',
    ),
    81 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 26 Jun 2019 16:55:04 +0000',
      'name' => 'SEO & Digital Marketing',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'seo-digital-marketing',
    ),
    82 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Mon, 26 Feb 2018 11:17:32 +0000',
      'name' => 'Shoes Store',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'shoes-store',
    ),
    83 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:17:21 +0000',
      'name' => 'Simple Beige Design',
      'description' => '',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'simple-beige-design',
    ),
    84 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:19:34 +0000',
      'name' => 'Snow Screensaver (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'snow-screensaver-video',
    ),
    85 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 11:44:39 +0000',
      'name' => 'Snowboarding Blog',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'snowboarding-blog',
    ),
    86 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:21:19 +0000',
      'name' => 'Snowy Mountain',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'snowy-mountain',
    ),
    87 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Nov 2018 10:24:22 +0000',
      'name' => 'Snowy Oasis',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'snowy-oasis',
    ),
    88 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 10 Apr 2019 17:03:10 +0000',
      'name' => 'Social Media Service',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'social-media-service',
    ),
    89 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 17 Feb 2019 12:27:43 +0000',
      'name' => 'Spa & Beauty Studio',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'spa-beauty-studio',
    ),
    90 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Thu, 30 May 2019 17:05:57 +0000',
      'name' => 'Spa',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'spa',
    ),
    91 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Fri, 30 Mar 2018 09:59:40 +0000',
      'name' => 'Spring',
      'description' => '',
      'frontpage' => '0',
      'status' => 'agency',
      'name_clean' => 'spring',
    ),
    92 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sat, 26 Jan 2019 16:30:01 +0000',
      'name' => 'Startup',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'startup',
    ),
    93 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 19 Aug 2018 07:48:14 +0000',
      'name' => 'Stylish Workplace',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'stylish-workplace',
    ),
    94 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 26 Jun 2019 17:26:44 +0000',
      'name' => 'TechExpo',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'techexpo',
    ),
    95 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:22:49 +0000',
      'name' => 'The Big City Newsletter',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'the-big-city-newsletter',
    ),
    96 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.14',
      'last_edit' => 'Thu, 22 Mar 2018 11:33:57 +0000',
      'name' => 'The Sunny View',
      'description' => 'Andrea',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'the-sunny-view',
    ),
    97 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.001',
      'last_edit' => 'Tue, 20 Feb 2018 10:57:27 +0000',
      'name' => 'Travel Agency',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'travel-agency',
    ),
    98 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.05',
      'last_edit' => 'Fri, 02 Mar 2018 12:39:22 +0000',
      'name' => 'Travel Blog',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'travel-blog',
    ),
    99 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:24:56 +0000',
      'name' => 'Tulips',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'tulips',
    ),
    100 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sun, 27 Jan 2019 08:47:12 +0000',
      'name' => 'Valentine&#39;s Day',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'valentines-day',
    ),
    101 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.001',
      'last_edit' => 'Mon, 19 Feb 2018 12:31:48 +0000',
      'name' => 'Video Production',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'video-production',
    ),
    102 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Thu, 04 Apr 2019 16:55:28 +0000',
      'name' => 'Virtual Assistant Service',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'virtual-assistant-service',
    ),
    103 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Sat, 07 Jul 2018 15:15:19 +0000',
      'name' => 'Walking Away (Video)',
      'description' => '',
      'frontpage' => '0',
      'status' => 'pro',
      'name_clean' => 'walking-away-video',
    ),
    104 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Mon, 26 Feb 2018 19:54:07 +0000',
      'name' => 'Webinar',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'webinar',
    ),
    105 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.005',
      'last_edit' => 'Fri, 23 Feb 2018 11:53:23 +0000',
      'name' => 'Wedding Blog',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'wedding-blog',
    ),
    106 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Tue, 22 May 2018 12:41:04 +0000',
      'name' => 'White Orchids',
      'description' => '',
      'frontpage' => '1',
      'status' => 'pro',
      'name_clean' => 'white-orchids',
    ),
    107 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '5.14',
      'last_edit' => 'Thu, 22 Mar 2018 11:29:56 +0000',
      'name' => 'Working Out',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'working-out',
    ),
    108 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.05',
      'last_edit' => 'Fri, 02 Mar 2018 12:36:42 +0000',
      'name' => 'Workplace',
      'description' => 'Andrea',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'workplace',
    ),
    109 => 
    array (
      'type' => 'CSMM PRO',
      'version' => '15.17',
      'last_edit' => 'Wed, 25 Apr 2018 11:00:38 +0000',
      'name' => 'Writing Service (Video)',
      'description' => '',
      'frontpage' => '1',
      'status' => 'agency',
      'name_clean' => 'writing-service-video',
    ),
  );

  $themes = array_reverse($themes);

  $path = plugins_url('', __FILE__);

  echo '<p style="font-size: 16px;">No time to create the perfect page? No worries! We have <b>over 100 perfect themes</b> for you to choose from. <b>Grab any theme with a 25% DISCOUNT!</b></p>';

  foreach ($themes as $theme) {
    echo '<div class="theme-thumb" data-theme="' . $theme['name_clean'] . '">';
    echo '<a href="' . nifty_generate_web_link('preview-theme-thumb-' . $theme['name_clean'], 'theme-preview', array('theme' => $theme['name_clean'])) . '" target="_blank"><img src="' . $path . '/assets/images/themes/pro/' . $theme['name_clean'] . '.jpg" alt="Preview ' . $theme['name'] . '" title="Preview ' . $theme['name'] . '"></a>';
    echo '<span class="name">' . $theme['name'] . ' <small>' . $theme['status'] . ' theme</small></span>';
    echo '<span name="actions">';
    echo '<a href="' . nifty_generate_web_link('get-theme-discount-' . $theme['name_clean'], '/', array('coupon' => 'nifty')) . '" class="button button-primary" target="_blank">Get this theme with a <b>25% discount</b></a>&nbsp; &nbsp;';
    echo '<a target="_blank" class="button button-secondary" href="' . nifty_generate_web_link('preview-theme-' . $theme['name_clean'], 'theme-preview', array('theme' => $theme['name_clean'])) . '">Preview</a>';
    echo '</span>';
    //echo '<div class="ribbon"><i><span class="dashicons dashicons-star-filled"></span></i></div>';
    echo '</div>';

  } // foreach theme
}


  // helper function to generate tagged buy links
  function nifty_generate_web_link($placement = '', $page = '/', $params = array(), $anchor = '') {
    $base_url = 'https://comingsoonwp.com';

    if ('/' != $page) {
      $page = '/' . trim($page, '/') . '/';
    }
    if ($page == '//') {
      $page = '/';
    }

    $parts = array_merge(array('utm_source' => 'nifty-free', 'utm_medium' => 'plugin', 'utm_content' => $placement, 'utm_campaign' => 'nifty-free-v' . nifty_get_plugin_version()), $params);

    if (!empty($anchor)) {
      $anchor = '#' . trim($anchor, '#');
    }

    $out = $base_url . $page . '?' . http_build_query($parts, '', '&amp;') . $anchor;

    return $out;
  } // generate_web_link


/**
 * Returns an array of system fonts
 */
 $google_fonts = nifty_cs_get_google_webfonts();
  foreach( $google_fonts as $font ) {
    $google_webfonts_array[$font['family']]['label'] = $font['family'];
    $google_webfonts_array[$font['family']]['value'] = $font['family'];
  }

  $weforms_form_enable = ot_get_option( 'weforms_sign_up_form_enable' );
  $weforms_form = ot_get_option( 'weforms_sign_up_form' );
  $enable_signup_form = ot_get_option( 'enable_sign_up_form' );

  if($weforms_form_enable == 'off' && $enable_signup_form != 'off' && $enable_signup_form != 'on'){
    $nifty_options = get_option( ot_options_id());  
    if($nifty_options['coming_soon_mode_on___off'] == 'on'){
        $nifty_options['enable_sign_up_form'] = 'off';
        $nifty_options['weforms_sign_up_form_enable'] = '';
        $nifty_options['weforms_sign_up_form'] = '';
        update_option( ot_options_id(), $nifty_options );
    }
  }

  
  
  if( ot_is_weforms_active() && !empty($weforms_form) && $weforms_form > 0 && $enable_signup_form != 'off'){
    $signup_form = array(
      'id'          => 'weforms_sign_up_form',
      'label'       => 'Any Kind of Form - Contact, Subscribe, Event, Optin,...',
      'desc'        => 'weForms allow you to create and fully customize any kind of form you need. From a simple contact or subscribe forms, to a complicated form for event registrations.',
      'std'         => '-1',
      'type'        => 'weforms',
      'section'     => 'general_settings',
    );
  } else {
    $signup_form = array();
  }



  if( nifty_is_notificationx_really_setup_and_active() && $enable_signup_form != 'off') {
    $notificationx_setting = array(
      'id'          => 'notificationx_notification',
      'label'       => 'Notifications',
      'desc'        => 'Create, edit and manage notifications on the <a href="' . admin_url('edit.php?post_type=notificationx') . '">NotificationX page</a>.',
      'std'         => '-1',
      'type'        => 'notificationx',
      'section'     => 'general_settings',
    );
  } else {
    $notificationx_setting = array(
        'id'          => 'display_notificationx_bar',
        'label'       => 'Display Notification Bar',
        'desc'        => '<p class="description">Add notifications to instantly engage and influence your visitors\' actions using social proof.</p><p class="description">To add notifications <a href="#" class="open-notificationx-upsell">install the free NotificationX plugin</a>. It seamlessly integrates with Nifty and offers numerous options.</p>
        ',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general_settings',
    );
  }


  $custom_settings = array(
    'contextual_help' => array(
      'sidebar'       => ''
    ),
    'sections'        => array(
      array(
        'id'          => 'general_settings',
        'title'       => 'General Settings'
      ),
      array(
        'id'          => 'themes',
        'title'       => 'Themes'
      ),
      array(
        'id'          => 'design_and_layout',
        'title'       => 'Design and Layout'
      ),
      array(
        'id'          => 'translation',
        'title'       => 'Translation'
      ),
      array(
        'id'          => 'social_links',
        'title'       => 'Social links'
      ),
      array(
        'id'          => 'documentation',
        'title'       => 'Documentation'
      )
    ),
    'settings'        => array(
      array(
        'id'          => 'themes2',
        'label'       => 'Themes',
        'desc'        => '',
        'std'         => '',
        'type'        => 'custom_themes',
        'section'     => 'themes',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'general_settings',
        'label'       => 'General settings',
        'desc'        => 'Here you can manage general settings. You can disable or enable Coming soon / Maintenace page or any of its sections. You can also add your Google Analytics code and Additional CSS.',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'general_settings',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',

        'operator'    => 'and'
      ),
      array(
        'id'          => 'coming_soon_mode_on___off',
        'label'       => 'Enable coming soon mode',
        'desc'        => 'Enable of disable coming soon mode.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general_settings',
        'min_max_step'=> '',
		'sidebar'   => '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      $notificationx_setting,
      array(
        'id'          => 'display_count_down_timer',
        'label'       => 'Display count down timer',
        'desc'        => 'Enable or disable count down timer on the home page.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general_settings',

      ),
      array(
        'id'          => 'enable_preloader',
        'label'       => 'Enable Preloader',
        'desc'        => 'Enable of disable preloader of coming soon page.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general_settings',
      ),
      $signup_form,
	  array(
        'id'          => 'enable_sign_up_form',
        'label'       => 'Enable built in Sign-up form',
        'desc'        => 'If you want to use custom Sign-up form option below, you need to turn this option to off.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general_settings',
      ),
      array(
        'id'          => 'insert_custom_signup_form',
        'label'       => 'Insert custom Sign-up form',
        'desc'        => 'You can use your MailChimp (or any other custom) embed code and replace the theme build in sign up form. Make sure that the upper option Enable built in Sign-up form is turned off.<br /><br />Please note that you need to adjust the elements that you paste inside this form, remove any remote CSS and use Additional CSS field for adjusting your form styles as well.',
        'std'         => '',
        'type'        => 'javascript',
        'section'     => 'general_settings',
        'min_max_step'=> '',
        'class'       => '',
         'condition'   => 'enable_sign_up_form:not(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_contact_details',
        'label'       => 'Enable Contact details',
        'desc'        => 'Enable of disable Contact details on the second tab of the coming soon page.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general_settings',

      ),
      array(
        'id'          => 'enable_social_links',
        'label'       => 'Enable Social links',
        'desc'        => 'Enable of disable Social links on the third tab of the coming soon page.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general_settings',

      ),
	  array(
        'id'          => 'disable_navigation',
        'label'       => 'Navigation',
        'desc'        => 'Enable of disable navigation buttons that are just below the logo section.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general_settings',

      ),
	  	  array(
        'id'          => 'disable_animation',
        'label'       => 'Text animation',
        'desc'        => 'Enable of disable text animation.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general_settings',

      ),
      array(
        'id'          => 'insert_google_analytics_code',
        'label'       => 'Google Analytics code',
        'desc'        => 'Enter your Google Analytics code that will be added in your coming soon page footer. Make sure to include &lt; script &gt; tags.',
        'std'         => '',
        'type'        => 'javascript',
        'section'     => 'general_settings',

      ),
	   array(
        'id'          => 'insert_additional_css',
        'label'       => 'Additional CSS',
        'desc'        => 'You can enter your custom CSS code that can override theme default classes, just remember to add !important at the end of your CSS statements.<br /><br />See example below:<br /><br /><pre>.nifty-coming-soon-message {<br />   font-size: 3em !important;<br />}</pre>',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general_settings',

      ),

      array(
        'id'          => 'design_and_layout_settings',
        'label'       => 'Design and Layout settings',
        'desc'        => 'Here you can setup your desired text, adjust date and time for the counter and setup the slider images for the background slider. You can also setup the pattern overlay with the opacity control, assign desired Google Fonts and more.',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'design_and_layout',

      ),
	  array(
        'id'          => 'disable_logo',
        'label'       => 'Display logo',
        'desc'        => 'Enable of disable logo image.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'upload_your_logo',
        'label'       => 'Upload your logo',
        'desc'        => 'Upload your logo here, it will be placed at the top of the coming soon page.<br /><br />
		TIP: You should use some png images with 200x90px in size.',
        'std'         => OT_URL .'/assets/images/logo.png',
        'type'        => 'upload',
        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_logo:not(off)',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'display_site_title',
        'label'       => 'Display Site title',
        'desc'        => 'If you dont use logo image, you can enable this option and display Site title.<br /><br />
		TIP: You can adjust Site title inside <em>Settings -> General.</em>',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_logo:not(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'your_coming_soon_message',
        'label'       => 'Your coming soon message',
        'desc'        => 'Enter your coming soon message here.',
        'std'         => 'Our website is coming very soon',
        'type'        => 'text',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'page_title',
        'label'       => 'Page Title',
        'desc'        => 'Page title, for SEO. Keep it short.',
        'std'         => get_bloginfo('name') . ' is coming soon',
        'type'        => 'text',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'page_description',
        'label'       => 'Page Description',
        'desc'        => 'Page description, for SEO. Keep it between 50 and 300 chars.',
        'std'         => 'We are doing some work on our site. Please be patient. Thank you.',
        'type'        => 'text',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'enter_second_coming_soon_message',
        'label'       => 'Your second coming soon message',
        'desc'        => 'This second message will be animated over the first message. So, you can have more that one sentence for your message. ;)',
        'std'         => 'Feel free to drop-by any time soon',
        'type'        => 'text',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'setup_the_count_down_timer',
        'label'       => 'Enter the countdown ending date / time',
        'desc'        => 'Specify the date and time of your count down timer expiration. If you leave this field empty, the countdown will not be displayed.',
        'std'         => '',
        'type'        => 'date-time-picker',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'countdown_font_color',
        'label'       => 'Countdown timer numbers color',
        'desc'        => 'Main color for countdown timer - for the big numbers.',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'countdown_font_color_bottom',
        'label'       => 'Countdown timer labels color',
        'desc'        => 'Secondary color for countdown timer - for the smaller labels below.',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'background_color',
        'label'       => 'Background color',
        'desc'        => 'Setup the default background color if you do not want to use the background image slider.',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'design_and_layout',

      ),
	  array(
        'id'          => 'sign_up_button_color',
        'label'       => 'Button color',
        'desc'        => 'Setup the desired Sign-up button color.',
        'std'         => '#9e0039',
        'type'        => 'colorpicker',
        'section'     => 'design_and_layout',

      ),
	  array(
        'id'          => 'sign_up_button_color_hover',
        'label'       => 'Button hover color',
        'desc'        => 'Setup the desired Sign-up button hover color.',
        'std'         => '#9e0039',
        'type'        => 'colorpicker',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'disable_background_image_slider',
        'label'       => 'Background image slider',
        'desc'        => 'Enable or disable background image slider.<br /><br />NOTICE:You need to disable background image slider if you want to use only background color option.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'design_and_layout',

      ),
	  array(
        'id'          => 'background_slider_time',
        'label'       => 'Enter background slider rotation time',
        'desc'        => 'Here you can enter desired time per slide. For example, 10000 equals to 10 seconds.',
        'std'         => '10000',
        'type'        => 'text',
        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'background_slider_animation_time',
        'label'       => 'Enter transition duration time',
        'desc'        => 'You can specify the time needed for transition effect to complete. For example, 2000 equals to 2 seconds.',
        'std'         => '2000',
        'type'        => 'text',
        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'upload_slider_images',
        'label'       => 'Upload first background slider images',
        'desc'        => 'Here you can upload your cover images, the best dimensions should be 1920x1080 or any with similar proportions.',
        'std'         => OT_URL .'assets/slideshow/1.jpg',
        'type'        => 'upload',
        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'upload_slider_images_2',
        'label'       => 'Upload second background slider images',
        'desc'        => 'Here you can upload your cover images, the best dimensions should be 1920x1080 or any with similar proportions.',
        'std'         => OT_URL .'assets/slideshow/2.jpg',
        'type'        => 'upload',
        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'upload_slider_images_3',
        'label'       => 'Upload third background slider images',
        'desc'        => 'Here you can upload your cover images, the best dimensions should be 1920x1080 or any with similar proportions.',
        'std'         => OT_URL .'assets/slideshow/3.jpg',
        'type'        => 'upload',

        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'upload_slider_images_4',
        'label'       => 'Upload fourth background slider images',
        'desc'        => 'Here you can upload your cover images, the best dimensions should be 1920x1080 or any with similar proportions.',
        'std'         => OT_URL .'assets/slideshow/4.jpg',
        'type'        => 'upload',

        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'background_slider_animation',
        'label'       => 'Choose animation for the background slider',
        'desc'        => 'Here you can select the desired animation between background slides, you can use the Random option and use all.',
        'std'         => 'random',
        'type'        => 'select',
		'choices'     => array(
          array(
            'value'       => 'random',
            'label'       => 'Random',
          ),
		  array(
            'value'       => 'fade',
            'label'       => 'Fade',
          ),
		  array(
            'value'       => 'fade2',
            'label'       => 'Fade 2',
          ),
		  array(
            'value'       => 'slideLeft',
            'label'       => 'Slide Left',
          ),
		  array(
            'value'       => 'slideLeft2',
            'label'       => 'Slide Left 2',
          ),
		  array(
            'value'       => 'slideRight',
            'label'       => 'Slide Right',
          ),
		  array(
            'value'       => 'slideRight2',
            'label'       => 'Slide Right 2',
          ),
		  array(
            'value'       => 'slideUp',
            'label'       => 'Slide Up',
          ),
		   array(
            'value'       => 'slideUp2',
            'label'       => 'Slide Up 2',
          ),
		  array(
            'value'       => 'slideDown',
            'label'       => 'Slide Down',
          ),
		  array(
            'value'       => 'slideDown2',
            'label'       => 'Slide Down 2',
          ),
		  array(
            'value'       => 'zoomIn',
            'label'       => 'Zoom In',
          ),
		  array(
            'value'       => 'zoomIn2',
            'label'       => 'Zoom In 2',
          ),
		  array(
            'value'       => 'zoomOut',
            'label'       => 'Zoom Out',
          ),
		  array(
            'value'       => 'zoomOut2',
            'label'       => 'Zoom Out 2',
          ),
		  array(
            'value'       => 'swirlLeft',
            'label'       => 'Swirl Left',
          ),
		  array(
            'value'       => 'swirlLeft2',
            'label'       => 'Swirl Left 2',
          ),
		  array(
            'value'       => 'swirlRight',
            'label'       => 'Swirl Right',
          ),
		  array(
            'value'       => 'swirlRight2',
            'label'       => 'Swirl Right 2',
          ),
		  array(
            'value'       => 'swirlUp',
            'label'       => 'Swirl Up',
          ),
		  array(
            'value'       => 'swirlUp2',
            'label'       => 'Swirl Up 2',
          ),
		  array(
            'value'       => 'swirlDown',
            'label'       => 'Swirl Down',
          ),
		  array(
            'value'       => 'swirlDown2',
            'label'       => 'Swirl Down 2',
          ),
		  array(
            'value'       => 'burn',
            'label'       => 'Burn',
          ),
		  array(
            'value'       => 'burn2',
            'label'       => 'Burn 2',
          ),
		  array(
            'value'       => 'blur',
            'label'       => 'Blur',
          ),
		  array(
            'value'       => 'blur2',
            'label'       => 'Blur 2',
          ),
		  array(
            'value'       => 'flash',
            'label'       => 'Flash',
          ),
		  array(
            'value'       => 'flash2',
            'label'       => 'Flash 2',
          ),

		  ),
        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'select_pattern_overlay',
        'label'       => 'Select pattern overlay',
        'desc'        => '',
        'std'         => '16.png',
        'type'        => 'radio-image',
        'section'     => 'design_and_layout',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => '01.png',
            'label'       => 'Pattern 1',
            'src'         => OT_URL .'assets/images/patterns/01.png'
          ),
          array(
            'value'       => '02.png',
            'label'       => 'Pattern 2',
            'src'         => OT_URL .'assets/images/patterns/02.png'
          ),
          array(
            'value'       => '03.png',
            'label'       => 'Pattern 3',
            'src'         => OT_URL .'assets/images/patterns/03.png'
          ),
          array(
            'value'       => '04.png',
            'label'       => 'Pattern 4',
            'src'         => OT_URL .'assets/images/patterns/04.png'
          ),
          array(
            'value'       => '05.png',
            'label'       => 'Pattern 5',
            'src'         => OT_URL .'assets/images/patterns/05.png'
          ),
          array(
            'value'       => '06.png',
            'label'       => 'Pattern 6',
            'src'         => OT_URL .'assets/images/patterns/06.png'
          ),
          array(
            'value'       => '07.png',
            'label'       => 'Pattern 7',
            'src'         => OT_URL .'assets/images/patterns/07.png'
          ),
          array(
            'value'       => '08.png',
            'label'       => 'Pattern 8',
            'src'         => OT_URL .'assets/images/patterns/08.png'
          ),
          array(
            'value'       => '09.png',
            'label'       => 'Pattern 9',
            'src'         => OT_URL .'assets/images/patterns/09.png'
          ),
          array(
            'value'       => '10.png',
            'label'       => 'Pattern 10',
            'src'         => OT_URL .'assets/images/patterns/10.png'
          ),
          array(
            'value'       => '11.png',
            'label'       => 'Pattern 11',
            'src'         => OT_URL .'assets/images/patterns/11.png'
          ),
          array(
            'value'       => '12.png',
            'label'       => 'Pattern 12',
            'src'         => OT_URL .'assets/images/patterns/12.png'
          ),
          array(
            'value'       => '13.png',
            'label'       => 'Pattern 13',
            'src'         => OT_URL .'assets/images/patterns/13.png'
          ),
          array(
            'value'       => '14.png',
            'label'       => 'Pattern 14',
            'src'         => OT_URL .'assets/images/patterns/14.png'
          ),
          array(
            'value'       => '15.png',
            'label'       => 'Pattern 15',
            'src'         => OT_URL .'assets/images/patterns/15.png'
          ),
          array(
            'value'       => '16.png',
            'label'       => 'Pattern 16',
            'src'         => OT_URL .'assets/images/patterns/16.png'
          ),
          array(
            'value'       => '17.png',
            'label'       => 'No pattern',
            'src'         => OT_URL .'assets/images/patterns/17.png'
          )
        )
      ),
      array(
        'id'          => 'pattern_overlay_opacity',
        'label'       => 'Set the pattern overlay opacity',
        'desc'        => 'Adjust the level of opacity / transparency for the overall pattern overlay.',
        'std'         => '0.5',
        'type'        => 'numeric-slider',
        'section'     => 'design_and_layout',
        'min_max_step'=> '0,1,0.1',
        'class'       => '',
        'condition'   => 'disable_background_image_slider:not(off)',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'choose_sitetitle_font',
        'label'       => 'Choose Site Title font',
        'desc'        => 'Here you can assign the font for your Site title heading, if you use are using Logo you can ignore this option.',
        'std'         => 'Lato',
        'type'        => 'select',
        'section'     => 'design_and_layout',
		'choices'     => $google_webfonts_array,

      ),
      array(
        'id'          => 'choose_heading_font',
        'label'       => 'Choose heading font',
        'desc'        => 'Here you can assign the main heading font for your coming soon page.',
        'std'         => 'Lato',
        'type'        => 'select',
        'section'     => 'design_and_layout',
		'choices'     => $google_webfonts_array,

      ),
	  array(
        'id'          => 'choose_counter_font',
        'label'       => 'Choose counter font',
        'desc'        => 'Here you can assign the font for countdown timer.',
        'std'         => 'Raleway',
        'type'        => 'select',
        'section'     => 'design_and_layout',
		'choices'     => $google_webfonts_array,

      ),
      array(
        'id'          => 'choose_paragraph_font',
        'label'       => 'Choose paragraph font',
        'desc'        => 'Here you can assign paragraph font for your coming soon page.',
        'std'         => 'Open+Sans',
        'type'        => 'select',
        'section'     => 'design_and_layout',
		'choices'     => $google_webfonts_array,

      ),
      array(
        'id'          => 'enter_you_website_or_company_name',
        'label'       => 'Enter you website or company name',
        'desc'        => 'This text will be present at the location tab in the footer section of the coming soon page.',
        'std'         => 'ACME COMPANY',
        'type'        => 'text',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'enter_your_address',
        'label'       => 'Enter you address',
        'desc'        => 'This text will be present at the location tab in the footer section of the coming soon page.',
        'std'         => '230 New Found lane, 8900 New City',
        'type'        => 'text',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'enter_your_phone_number',
        'label'       => 'Enter your phone number',
        'desc'        => 'The number will be present at the location tab in the footer section of the coming soon page.',
        'std'         => '+555 53211 777',
        'type'        => 'text',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'enter_your_email_address',
        'label'       => 'Enter your email address',
        'desc'        => 'This address will be used for receiving notifications from the subscription form on the coming soon page. It will also be displayed on the location tab of the footer section.<br><b>Emails are not stored in WordPress nor sent to any 3rd party services like MailChimp. You will only receive them on this email address.</b>',
        'std'         => 'someone@example.com',
        'type'        => 'text',
        'section'     => 'design_and_layout',

      ),
      array(
        'id'          => 'translation_settings',
        'label'       => 'Translation settings',
        'desc'        => 'Here you can replace the default coming soon language variables. Just enter your desired text and save changes.',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'translation',

      ),
      array(
        'id'          => 'sign_up_form_intro_text',
        'label'       => 'Sign-up form intro text',
        'desc'        => 'Here you can specify the desired intro text of your sign-up from.',
        'std'         => 'Sign up to find out when we launch',
        'type'        => 'text',
        'section'     => 'translation',

      ),
      array(
        'id'          => 'sign_up_button_text',
        'label'       => 'Sign up button text',
        'desc'        => 'Here you can replace the default Sign up buttons text.',
        'std'         => 'Sign Up',
        'type'        => 'text',
        'section'     => 'translation',

      ),
      array(
        'id'          => 'social_links_intro_text',
        'label'       => 'Social links intro text',
        'desc'        => 'Here you can translate the intro text above the social icons on the last tab of the footer section.',
        'std'         => 'Are you social? We are, find us below ;)',
        'type'        => 'text',
        'section'     => 'translation',

      ),
      array(
        'id'          => 'enter_email_text',
        'label'       => 'Enter Email text',
        'desc'        => 'Here you can translate text inside the subscription form.',
        'std'         => 'Enter Email...',
        'type'        => 'text',
        'section'     => 'translation',

      ),
      array(
        'id'          => 'email_confirmation___error',
        'label'       => 'Email confirmation - Error',
        'desc'        => 'Here you can translate the error message from the form submition.',
        'std'         => 'Please, enter valid email address.',
        'type'        => 'text',
        'section'     => 'translation',

      ),
      array(
        'id'          => 'email_confirmation___success',
        'label'       => 'Email confirmation - Success',
        'desc'        => 'Here you can translate the success message from the form submition.',
        'std'         => 'You will be notified, thanks.',
        'type'        => 'text',
        'section'     => 'translation',

      ),
	  array(
        'id'          => 'nifty_days_translate',
        'label'       => 'Translate the word "days"',
        'desc'        => 'Here you can translate the language string for "days" label, just below the counter.',
        'std'         => 'days',
        'type'        => 'text',
        'section'     => 'translation',

      ),
	  array(
        'id'          => 'nifty_hours_translate',
        'label'       => 'Translate the word "hours"',
        'desc'        => 'Here you can translate the language string for "hours" label, just below the counter.',
        'std'         => 'hours',
        'type'        => 'text',
        'section'     => 'translation',

      ),
	  array(
        'id'          => 'nifty_minutes_translate',
        'label'       => 'Translate the word "minutes"',
        'desc'        => 'Here you can translate the language string for "minutes" label, just below the counter.',
        'std'         => 'minutes',
        'type'        => 'text',
        'section'     => 'translation',

      ),
	  array(
        'id'          => 'nifty_seconds_translate',
        'label'       => 'Translate the word "seconds"',
        'desc'        => 'Here you can translate the language string for "seconds" label, just below the counter.',
        'std'         => 'seconds',
        'type'        => 'text',
        'section'     => 'translation',

      ),
      array(
        'id'          => 'social_settings',
        'label'       => 'Social settings',
        'desc'        => 'In order to link the social icons on the coming soon page with your social network pages or accounts, just enter your social profile URL\'s in the provided fields and save changes.',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'social_links',

      ),
      array(
        'id'          => 'facebook_page_or_profile_url',
        'label'       => 'Facebook page or profile URL',
        'desc'        => 'Enter your full Facebook page or profile URL along with https://',
        'std'         => '#link',
        'type'        => 'text',
        'section'     => 'social_links',

      ),
      array(
        'id'          => 'twitter_url',
        'label'       => 'Twitter URL',
        'desc'        => 'Enter your Twitter URL along with https://',
        'std'         => '#link',
        'type'        => 'text',
        'section'     => 'social_links',

      ),
      array(
        'id'          => 'linkedin_profile_url',
        'label'       => 'LinkedIn profile URL',
        'desc'        => 'Enter your LinkedIn profile URL along with https://',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',

      ),
	   array(
        'id'          => 'pinterest_url',
        'label'       => 'Pinterest URL',
        'desc'        => 'Enter your Pinterest URL along with https://',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',

      ),
	   array(
        'id'          => 'instagram_url',
        'label'       => 'Instagram profile URL',
        'desc'        => 'Enter your Instagram profile URL along with https://',
        'std'         => '#link',
        'type'        => 'text',
        'section'     => 'social_links',

      ),
      array(
        'id'          => 'vimeo_url',
        'label'       => 'Vimeo profile or movie URL',
        'desc'        => 'Enter your Vimeo profile or video URL along with https://',
        'std'         => '#link',
        'type'        => 'text',
        'section'     => 'social_links',

      ),
      array(
        'id'          => 'google___profile_or_page_url',
        'label'       => 'Google + profile or page URL',
        'desc'        => 'Enter your Google+ page or profile URL along with https://',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_links',

      ),
      array(
        'id'          => 'documentation_and_faq',
        'label'       => 'Documentation and FAQ',
        'desc'        => '<h3 class="label">NIFTY COMING SOON - Documentation</strong></h3>

		<p>We\'re working on creating videos and written documentation. Till then, if you have any questions use the following places to ask for help:</p>
		<ul>
		<li><a href="https://wordpress.org/support/plugin/nifty-coming-soon-and-under-construction-page" target="_blank">WordPress Support forum</a></li>
		<li><a href="https://twitter.com/WebFactoryLtd" target="_blank">WebFactory on Twitter</a></li>
		</ul>
		<h3 class="label">RATE THE PLUGIN WITH 5 STARS</h3>
		<p>If you find this plugin useful, please take a minute and rate it with 5 start on WordPress. It will help me with keeping up with the updates and new features as always.</p>
		<p>Just log in into Your WordPress account and then access the <a href="https://wordpress.org/support/plugin/nifty-coming-soon-and-under-construction-page/reviews" target="_blank"> Review page </a>. Then just click on the button Add my review, make sure that you mark the 5 star and submit your review.</p>
		<p>Thanks. :)</p>
		</p>

		',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'documentation',

      )
    )
  );



  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings );
  }

  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;

}

add_filter( 'ot_show_pages', '__return_false' );


function ot_is_plugin_installed($slug) {
  if (!function_exists('get_plugins')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }
  $all_plugins = get_plugins();

  if (!empty($all_plugins[$slug])) {
    return true;
  } else {
    return false;
  }
} // is_plugin_installed

// check if weForms plugin is active and min version installed
function ot_is_weforms_active() {
  if (!function_exists('is_plugin_active') || !function_exists('get_plugin_data')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }

  if (is_plugin_active('weforms/weforms.php')) {
    $weforms_info = get_plugin_data(ABSPATH.'wp-content/plugins/weforms/weforms.php');
    if( version_compare($weforms_info['Version'], '1.3.3', '<')) {
      return false;
    } else {
      return true;
    }
  } else {
    return false;
  }
} // is_weforms_active

