# Rational Option Page Class
Rational Option Page Class is a PHP class used to build option pages for WordPress. You don't need to deal with all the hooks and functions. What you pass to this class is an associative array with your option page's structure and fields.

## Installation
* Download or clone the repo to your plugin or theme's root directory
* Include the class in your plugin's base file or your theme's `functions.php` file.

```php
if ( is_admin() ) {
	include 'rational-option-page/class.rational-option-page.php';
	$my_options_page = new RationalOptionPages();
}
```

## Configuration

I recommend using underscores as separators in all your slugs and IDs to keep it consistent. I haven't tested it extensively with hyphens. But they might work.

### Pages
The class builds your option page based off of a multidimensional associative array that you define. To get your top level page set up you would use something like this:

```php
$my_options_page_structure = array(
	// top level
	array(
		'page_title'	=> 'My Options Page',
		'menu_title'	=> 'My Options Page',
		'capability'	=> 'manage_options',
		'menu_slug'		=> 'my_options_page',
		'icon_url'		=> 'dashicons-editor-code',
		'position'		=> 61,
	),
);
$my_options_page->pages( $my_options_page_structure );
```
The above example defines the top level page, "My Options Page". It also sets an icon and positions it where I want it in the admin menu. It uses WordPress' `add_menu_page` to do this. You can add multiple pages via the same instance of the class by adding more arrays at the root level of the array passed to the `pages()` method.

For instance a second, top-level menu page could be added like so:
```php
$my_options_page_structure = array(
	// top level
	array(
		'page_title'	=> 'My Options Page',
		'menu_title'	=> 'My Options Page',
		'capability'	=> 'manage_options',
		'menu_slug'		=> 'my_options_page',
		'icon_url'		=> 'dashicons-editor-code',
		'position'		=> 61,
	),
	// a second top level
	array(
		'page_title'	=> 'Another Page',
		'menu_title'	=> 'Another Page',
		'capability'	=> 'manage_options',
		'menu_slug'		=> 'another_page',
	),
);
$my_options_page->pages( $my_options_page_structure );
```

#### Additional Resources
* More `icon_url` options: http://melchoyce.github.io/dashicons/
* More on `position`: https://codex.wordpress.org/Function_Reference/add_menu_page#Parameters

### Subpages
Subpages are defined within a "subpages" array inside the top level page. If we extend the above example:
```php
$my_options_page_structure = array(
	// top level
	array(
		'page_title'	=> 'My Options Page',
		'menu_title'	=> 'My Options Page',
		'capability'	=> 'manage_options',
		'menu_slug'		=> 'my_options_page',
		'icon_url'		=> 'dashicons-editor-code',
		'position'		=> 61,
		'subpages'		=> array(
			array(
				'page_title'	=> 'My Options Subpage',
				'menu_title'	=> 'My Options Subpage',
				'capability'	=> 'manage_options',
				'menu_slug'		=> 'my_options_subpage',
			),
		),
	),
);
```
The above example defines the subpage "My Options Subpage" of the parent "My Options Page". This is done using WordPress' `add_submenu_page` function.

As with pages, you can add multiple subpages under one page by including another array after the first:

```php
$my_options_page_structure = array(
	// top level
	array(
		'page_title'	=> 'My Options Page',
		'menu_title'	=> 'My Options Page',
		'capability'	=> 'manage_options',
		'menu_slug'		=> 'my_options_page',
		'icon_url'		=> 'dashicons-editor-code',
		'position'		=> 61,
		'subpages'		=> array(
			// subpage one
			array(
				'page_title'	=> 'My Options Subpage',
				'menu_title'	=> 'My Options Subpage',
				'capability'	=> 'manage_options',
				'menu_slug'		=> 'my_options_subpage',
			),
			// subpage two
			array(
				'page_title'	=> 'My Second Subpage',
				'menu_title'	=> 'My Second Subpage',
				'capability'	=> 'manage_options',
				'menu_slug'		=> 'my_second_subpage',
			),
		),
	),
);
```

#### Additional Resources
* WordPress' `add_submenu_page` function: https://codex.wordpress.org/Function_Reference/add_submenu_page

### Sections
Any page, page or subpage, can contain sections and fields. These are defined first by section arrays within that page or subpage's array. Again, expanding on the examples above:

```php
$my_options_page_structure = array(
	// top level
	array(
		'page_title'	=> 'My Options Page',
		'menu_title'	=> 'My Options Page',
		'capability'	=> 'manage_options',
		'menu_slug'		=> 'my_options_page',
		'icon_url'		=> 'dashicons-editor-code',
		'position'		=> 61,
		'sections'		=> array(
			array(
				'id'	=> 'page_section',
				'title'	=> 'Page Section',
			),
		),
		'subpages'		=> array(
			array(
				'page_title'	=> 'My Options Subpage',
				'menu_title'	=> 'My Options Subpage',
				'capability'	=> 'manage_options',
				'menu_slug'		=> 'my_options_subpage',
				'sections'		=> array(
					array(
						'id'	=> 'subpage_section',
						'title'	=> 'Subpage Section',
					),
				),
			),
		),
	),
);
```
The above example adds sections to both the main page and the subpage. These sections are necessary as they will contain the fields. You can have multiple sections on one page by adding multiple arrays to the `sections` array. In much the same way you can create multiple pages and subpages within their respective arrays.

Based on WordPress' `add_settings_section`: https://codex.wordpress.org/Function_Reference/add_settings_section

### Fields
Fields are nested under the sections of our pages. You can have as many as you like, in the same way as with sections and pages, but the sections and pages should be utilized to keep them organized.

```php
$my_options_page_structure = array(
	// top level
	array(
		'page_title'	=> 'My Options Page',
		'menu_title'	=> 'My Options Page',
		'capability'	=> 'manage_options',
		'menu_slug'		=> 'my_options_page',
		'icon_url'		=> 'dashicons-editor-code',
		'position'		=> 61,
		'sections'		=> array(
			array(
				'id'	=> 'page_section',
				'title'	=> 'Page Section',
				'fields'		=> array(
					// text input
					array(
						'id'	=> 'sample_text',
						'title'	=> 'Sample Text',
						'type'	=> 'text',
					),
				),
			),
		),
	),
);

```
The above example creates a text input field, in the page section, on the top level page of our options.

Based on WordPress' `add_settings_field`: https://codex.wordpress.org/Function_Reference/add_settings_field

## Options
### Pages
* `page_title` : The text to be displayed in the title tags of the page when the menu is selected (required)
* `menu_title` : The on-screen name text for the menu (required)
* `capability` : The [capability](https://codex.wordpress.org/Roles_and_Capabilities) required for this menu to be displayed to the user (required)
* `menu_slug` : The slug name to refer to this menu by (should be unique for this menu) (required)
* `icon_url` : The [icon](http://melchoyce.github.io/dashicons/) for this menu
* `position` : The [position](https://codex.wordpress.org/Function_Reference/add_menu_page#Parameters) in the menu order this menu should appear
* `subpages` : Array of pages to appear under this one
* `sections` : Array of sections to appear on this page
### Subpages
Same as above but `icon_url`, `position` and `subpages` will be ignored.
### Sections
* `id` : String for use in the 'id' attribute of tags (required)
* `title` : Title of the section (required)
* `description` : HTML/Text to appear under the section's title
* `fields` : Array of fields to appear in this section
### Fields
There are a few options that are required for all fields:

* `id` : String used for field's ID and name (required)
* `title` : String used for field label (required)
* `type` : Determines what type of field is created (required)

Individual field types also have options specific to them. Some required:

#### Text, Search, URL, Tel, Email and Password

* `class` : Class applied to the text field (default: `regular-text`)
* `value` : Default value if no value stored in the database
* `pattern` : Specifies a [regular expression](http://www.w3schools.com/tags/att_input_pattern.asp) the field value is checked against
* `placeholder` : HTML5 placeholder attribute
* `size` : Specifies the visible width, in characters, of the field
* `maxlength` : Specifies the maximum number of characters allowed in the field
* `description` : Used as "help text" for the field
* `args` : An array of true/false arguments for the field
	*  `required`
	* `autocomplete`
	* `readonly`
	* `disabled`
	* `multiple` (email only)

#### Typography
* `class` : Class applied to the text field (default: `regular-text`)
* `description` : Used as "help text" for the field
* `value` : Default value if no value stored in the database
	* `font` : font readable by robot
	* `font-readable` : Font readable by human
	* `weight` : The font weight
	* `size` : size in pixel
	* `color` : 

* `List of avilable font` 
	* `Aclonica`
	* `Allan`
	* `Annie+Use+Your+Telescope`
	* `Anonymous+Pro`
	* `Allerta+Stencil`
	* `Allerta`
	* `Amaranth`
	* `Anton`
	* `Architects+Daughter`
	* `Arimo`
	* `Artifika`
	* `Arvo`
	* `Asset`
	* `Astloch`
	* `Bangers`
	* `Bentham`
	* `Bevan`
	* `Bigshot+One`
	* `Bowlby+One`
	* `Bowlby+One+SC`
	* `Brawler`
	* `Buda:300`
	* `Cabin`
	* `Calligraffitti`
	* `Candal`
	* `Cantarell`
	* `Cardo`
	* `Carter One`
	* `Caudex`
	* `Cedarville+Cursive`
	* `Cherry+Cream+Soda`
	* `Chewy`
	* `Coda`
	* `Coming+Soon`
	* `Copse`
	* `Corben:700`
	* `Cousine`
	* `Covered+By+Your+Grace`
	* `Crafty+Girls`
	* `Crimson+Text`
	* `Crushed`
	* `Cuprum`
	* `Damion`
	* `Dancing+Script`
	* `Dawning+of+a+New+Day`
	* `Didact+Gothic`
	* `Droid+Sans`
	* `Droid+Sans+Mono`
	* `Droid+Serif`
	* `EB+Garamond`
	* `Expletus+Sans`
	* `Fontdiner+Swanky`
	* `Forum`
	* `Francois+One`
	* `Geo`
	* `Give+You+Glory`
	* `Goblin+One`
	* `Goudy+Bookletter+1911`
	* `Gravitas+One`
	* `Gruppo`
	* `Hammersmith+One`
	* `Holtwood+One+SC`
	* `Homemade+Apple`
	* `Inconsolata`
	* `Indie+Flower`
	* `IM+Fell+DW+Pica`
	* `IM+Fell+DW+Pica+SC`
	* `IM+Fell+Double+Pica`
	* `IM+Fell+Double+Pica+SC`
	* `IM+Fell+English`
	* `IM+Fell+English+SC`
	* `IM+Fell+French+Canon`
	* `IM+Fell+French+Canon+SC`
	* `IM+Fell+Great+Primer`
	* `IM+Fell+Great+Primer+SC`
	* `Irish+Grover`
	* `Irish+Growler`
	* `Istok+Web`
	* `Josefin+Sans`
	* `Josefin+Slab`
	* `Judson`
	* `Jura`
	* `Jura:500`
	* `Jura:600`
	* `Just+Another+Hand`
	* `Just+Me+Again+Down+Here`
	* `Kameron`
	* `Kenia`
	* `Kranky`
	* `Kreon`
	* `Kristi`
	* `La+Belle+Aurore`
	* `Lato:100`
	* `Lato:100italic`
	* `Lato:300"`
	* `Lato`
	* `Lato:bold",`
	* `Lato:900`
	* `League+Script`
	* `Lekton",`
	* `Limelight",`
	* `Lobster`
	* `Lobster Two`
	* `Lora`
	* `Love+Ya+Like+A+Sister`
	* `Loved+by+the+King`
	* `Luckiest+Guy`
	* `Maiden+Orange`
	* `Mako`
	* `Maven+Pro`
	* `Maven+Pro:500`
	* `Maven+Pro:700`
	* `Maven+Pro:900`
	* `Meddon`
	* `MedievalSharp`
	* `Megrim`
	* `Merriweather`
	* `Metrophobic`
	* `Michroma`
	* `Miltonian Tattoo`
	* `Miltonian`
	* `Modern Antiqua`
	* `Monofett`
	* `Molengo`
	* `Mountains of Christmas`
	* `Muli:300"`
	* `Muli"`
	* `Neucha`
	* `Neuton`
	* `News+Cycle`
	* `Nixie+One`
	* `Nobile`
	* `Nova+Cut`
	* `Nova+Flat`
	* `Nova+Mono`
	* `Nova+Oval`
	* `Nova+Round`
	* `Nova+Script`
	* `Nova+Slim`
	* `Nova+Square`
	* `Nunito:light`
	* `Nunito`
	* `OFL+Sorts+Mill+Goudy+TT`
	* `Old+Standard+TT`
	* `Open+Sans:300`
	* `Open+Sans`
	* `Open+Sans:600`
	* `Open+Sans:800`
	* `Open+Sans+Condensed:300`
	* `Orbitron`
	* `Orbitron:500`
	* `Orbitron:700`
	* `Orbitron:900`
	* `Oswald`
	* `Over+the+Rainbow`
	* `Reenie+Beanie`
	* `Pacifico`
	* `Patrick+Hand`
	* `Paytone+One"`
	* `Permanent+Marker`
	* `Philosopher`
	* `Play`
	* `Playfair+Display`
	* `Podkova`
	* `Poppins`	
	* `PT+Sans`
	* `PT+Sans+Narrow`
	* `PT+Sans+Narrow:regular,bold`
	* `PT+Serif`
	* `PT+Serif Caption`
	* `Puritan`
	* `Quattrocento`
	* `Quattrocento+Sans`
	* `Radley`
	* `Raleway:100`
	* `Redressed`
	* `Rock+Salt`
	* `Rokkitt`
	* `Ruslan+Display`
	* `Schoolbell`
	* `Shadows+Into+Light`
	* `Shanti`
	* `Sigmar+One`
	* `Six+Caps`
	* `Slackey`
	* `Smythe`
	* `Sniglet:800`
	* `Special+Elite`
	* `Stardos+Stencil`
	* `Sue+Ellen+Francisco`
	* `Sunshiney`
	* `Swanky+and+Moo+Moo`
	* `Syncopate`
	* `Tangerine`
	* `Tenor+Sans`
	* `Terminal+Dosis+Light`
	* `The+Girl+Next+Door`
	* `Tinos`
	* `Ubuntu`
	* `Ultra`
	* `Unkempt`
	* `UnifrakturCook:bold`
	* `UnifrakturMaguntia`
	* `Varela`
	* `Varela Round`
	* `Vibur`
	* `Vollkorn`
	* `VT323`
	* `Waiting+for+the+Sunrise`
	* `Wallpoet`
	* `Walter+Turncoat`
	* `Wire+One`
	* `Yanone+Kaffeesatz`
	* `Yanone+Kaffeesatz:300`
	* `Yanone+Kaffeesatz:400`
	* `Yanone+Kaffeesatz:700`
	* `Yeseva+One`
	* `Zeyad`

#### Date, Datetime, Datetime-local, Month, Time and Week

* `class` : Class applied to the text field (default: `regular-text`)
* `value` : Default value if no value stored in the database
* `min` : Specifies the minimum value for the field
* `max` : Specifies the maximum value for the field
* `step` : Specifies the legal number intervals for the field
* `description` : Used as "help text" for the field
* `args` : An array of true/false arguments for the field
	*  `required`
	* `autocomplete`
	* `readonly`
	* `disabled`

#### Textarea

* `class` : Class applied to the text field (default: `regular-text`)
* `value` : Default value if no value stored in the database
* `placeholder` : HTML5 placeholder attribute
* `rows` : Specifies the visible height of a text area, in lines
* `cols` : Specifies the visible width of a text area
* `description` : Used as "help text" for the field
* `args` : An array of true/false arguments for the field
	*  `required`
	* `autocomplete`
	* `readonly`
	* `disabled`


#### Range and Number

* `class` : Class applied to the text field (default for number: `regular-text`)
* `value` : Default value if no value stored in the database
* `min` : Specifies the minimum value for the field
* `max` : Specifies the maximum value for the field
* `step` : Specifies the legal number intervals for the field
* `description` : Used as "help text" for the field
* `args` : An array of true/false arguments for the field
	* `disabled`

#### Color

* `class` : Class applied to the text field
* `value` : Default value if no value stored in the database
* `description` : Used as "help text" for the field
* `args` : An array of true/false arguments for the field
	* `disabled`

#### File

* `class` : Class applied to the text field
* `value` : Default value if no value stored in the database
* `description` : Used as "help text" for the field
* `args` : An array of true/false arguments for the field
	*  `required`
	* `disabled`

#### Checkbox

* `class` : Class applied to the text field
* `value` : Default value if no value stored in the database
* `description` : Used as a label for the field
* `args` : An array of true/false arguments for the field
	*  `required`
	* `disabled`


#### Radio

* `options` : (required) Array of choices/options (Example below)
* `class` : Class applied to the text field
* `value` : Default value if no value stored in the database
* `args` : An array of true/false arguments for the field
	* `disabled`

Sequential or associative arrays work for the options array.
```php
'options' => array(
	'Option One',
	'option-two' => 'Option Two',
)
```
The above array would result in something like this:

```php
<label><input type="radio" name="my_radio" value="Option One"> Option One</label><br>
<label><input type="radio" name="my_radio" value="option-two"> Option Two</label>
```
Notice that the key in the associative part of the array is used as the value of the input.

#### Select
* `options` : (required) Array of choices/options (Example below)
* `class` : Class applied to the text field
* `value` : Default value if no value stored in the database
* `description` : Used as "help text" for the field
* `args` : An array of true/false arguments for the field
	* `disabled`

Options in selects behave in the same way as in the radio fields but with a slightly different output. The array above would render something like this:

```php
<option>Option One</option>
<option value="option-two">Option Two</option>
```

### Example
This is a page array with one section and one of each category of field:

```php
$pages = array(
	// page
	array(
		'page_title'	=> 'My Options',
		'menu_title'	=> 'My Options',
		'capability'	=> 'manage_options',
		'menu_slug'		=> 'my_options',
		'description'	=> '<p>Some options for my theme.</p>',
		// subpage
		'sections'	=> array(
			array(
				'id'			=> 'sample_fields',
				'title'			=> 'Sample Fields',
				'description'	=> '<p>Sample fields supported by the class</p>',
				'fields'		=> array(
					array(
						'id'	=> 'sample_text',
						'title'	=> 'Sample Text',
						'type'	=> 'text',
						'description' => 'Things like text, search, url, tel, email and password.',
						'value' => 'Default value',
					),
					array(
						'id'	=> 'sample_textarea',
						'title'	=> 'Sample Textarea',
						'type'	=> 'textarea',
						'value'	=> 'Defaults to a large, code-style block but can easily be changed with class, rows and cols.',
					),
					array(
						'id'	=> 'sample_checkbox',
						'title'	=> 'Sample Checkbox',
						'type'	=> 'checkbox',
						'description' => 'Checkboxes of course.',
					),
					array(
						'id'	=> 'sample_radio',
						'title'	=> 'Sample Radio',
						'type'	=> 'radio',
						'options' => array(
							'Radio options are similar to those for selects',
							'radio-two' => 'Sequential or associative arrays work',
						),
					),
					array(
						'id'	=> 'sample_select',
						'title'	=> 'Sample Select',
						'type'	=> 'select',
						'options' => array(
							'Radio options are similar to those for selects',
							'radio-two' => 'Sequential or associative arrays work',
						),
						'description' => 'See? Same as the radio input above.'
					),
					array(
						'id'	=> 'sample_file',
						'title'	=> 'Sample File',
						'type'	=> 'file',
						'description' => 'Included file uploads for fun.'
					),
					array(
						'id' => 'sample_typography',
						'title' => sample typography,
						'type' => 'typography',
						'descrition' => 'Choose your font please',
						'value' => array(
							'font' => '',
							'font-readable' => '',
							'weight' => '300',
							'size' => '10px',
							'color' => '#444',
						)
					),
				),
			),
		),
	),
);
```

Try passing this array to the class and see what it generates.





## Retrieving Data

The data is stored like all other options in the `wp_options` table. It can be retrieved using the `get_option()` function and passing the `menu_slug` of the page where the field(s) are located with an underscore prepended and the string `_options` appended. For example, if your page's menu slug is `sample_page` you would retrieve the values by calling `get_option( '_sample_page_options' )`. This will return an array with your stored values. Read more: https://codex.wordpress.org/Function_Reference/get_option

## License
[The MIT License (MIT)](https://github.com/jeremyHixon/rational-option-page/blob/master/LICENSE)