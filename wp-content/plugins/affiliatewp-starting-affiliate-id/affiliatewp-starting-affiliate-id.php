<?php
/**
 * Plugin Name: AffiliateWP - Starting Affiliate ID
 * Plugin URI: https://affiliatewp.com
 * Description: Change the starting affiliate ID of your affiliate program.
 * Author: Sandhills Development, LLC
 * Author URI: https://sandhillsdev.com
 * Version: 1.0.0
 * Text Domain: affiliatewp-starting-affiliate-id
 * Domain Path: languages
 *
 * AffiliateWP is distributed under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * AffiliateWP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with AffiliateWP. If not, see <http://www.gnu.org/licenses/>.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Implements requirements checks and partial activation before bootstrapping the add-on.
 *
 * @since 1.0.0
 * @final
 */
final class AffWP_SAI_Requirements_Check {

	/**
	 * Plugin file path.
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	private $file = '';

	/**
	 * Plugin basename.
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	private $base = '';

	/**
	 * Requirements array.
	 *
	 * @since 1.0.0
	 * @var   array
	 */
	private $requirements = array(

		// PHP
		'php' => array(
			'minimum' => '5.6.0',
			'name'    => 'PHP',
			'exists'  => true,
			'current' => false,
			'checked' => false,
			'met'     => false
		),

		// WordPress
		'wp' => array(
			'minimum' => '5.0',
			'name'    => 'WordPress',
			'exists'  => true,
			'current' => false,
			'checked' => false,
			'met'     => false
		),

		// AffWP
		'affwp' => array(
			'minimum' => '2.3',
			'name'    => 'AffiliateWP',
			'exists'  => true,
			'current' => false,
			'checked' => false,
			'met'     => false
		),
	);

	/**
	 * Sets up the plugin requirements.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Setup file & base
		$this->file = __FILE__;
		$this->base = plugin_basename( $this->file );

		// Always load translations.
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		// Load or quit.
		$this->met() ? $this->load() : $this->quit();
	}

	/**
	 * Quit without loading
	 *
	 * @since 1.0.0
	 */
	private function quit() {
		add_action( 'admin_head',                        array( $this, 'admin_head'        ) );
		add_filter( "plugin_action_links_{$this->base}", array( $this, 'plugin_row_links'  ) );
		add_action( "after_plugin_row_{$this->base}",    array( $this, 'plugin_row_notice' ) );
	}

	/** Specific Methods ******************************************************/

	/**
	 * Load normally
	 *
	 * @since 1.0.0
	 */
	private function load() {

		// Load the bundled bootstrapper.
		if ( ! class_exists( 'AffiliateWP_Starting_Affiliate_ID' ) ) {
			require_once dirname( $this->file ) . '/includes/class-affiliatewp-starting-affiliate-id.php';
		}

		/*
		 * Bootstrap to plugins_loaded before priority 10 to make sure
		 * add-ons are loaded after us.
		 */
		add_action( 'plugins_loaded', array( $this, 'bootstrap' ), 4 );
	}

	/**
	 * Bootstraps the actual plugin file.
	 *
	 * @since 1.0.0
	 */
	public function bootstrap() {
		AffiliateWP_Starting_Affiliate_ID::instance( $this->file );
	}

	/**
	 * Plugin specific URL for an external requirements page.
	 *
	 * @since 1.0.0
	 *
	 * @return string URL to an externally-hosted minimum requirements document.
	 */
	private function unmet_requirements_url() {
		return 'https://docs.affiliatewp.com/article/2156-starting-affiliate-id-minimum-requirements';
	}

	/**
	 * Outputs plugin-specific text to quickly explain what's wrong (in the plugins list table).
	 *
	 * @since 1.0.0
	 *
	 * @return string Message to explain that partial activation is in effect.
	 */
	private function unmet_requirements_text() {
		esc_html_e( 'This plugin is not fully active.', 'affiliatewp-starting-affiliate-id' );
	}

	/**
	 * Retrieves plugin-specific text to describe a single unmet requirement.
	 *
	 * @since 1.0.0
	 *
	 * @return string Message for a single unmet requirement.
	 */
	private function unmet_requirements_description_text() {
		return esc_html__( 'Requires %s (%s), but (%s) is installed.', 'affiliatewp-starting-affiliate-id' );
	}

	/**
	 * Retrieves plugin-specific text to describe a single missing requirement.
	 *
	 * @since 1.0.0
	 *
	 * @return string Message for a single missing requirement.
	 */
	private function unmet_requirements_missing_text() {
		return esc_html__( 'Requires %s (%s), but it appears to be missing.', 'affiliatewp-starting-affiliate-id' );
	}

	/**
	 * Retrieves plugin-specific text used to link to an external requirements page.
	 *
	 * @since 1.0.0
	 *
	 * @return string Label to use when linking to the externally-hosted minimum requirements document.
	 */
	private function unmet_requirements_link() {
		return esc_html__( 'Requirements', 'affiliatewp-starting-affiliate-id' );
	}

	/**
	 * Retrieves plugin-specific aria label text to describe the requirements link.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	private function unmet_requirements_label() {
		return esc_html__( 'AffiliateWP - Starting Affiliate ID Requirements', 'affiliatewp-starting-affiliate-id' );
	}

	/**
	 * Retrieves plugin-specific text used in CSS to identify attribute IDs and classes.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	private function unmet_requirements_name() {
		return 'affiliatewp-starting-affiliate-id-requirements';
	}

	/** Agnostic Methods ******************************************************/

	/**
	 * Outputs an additional row in the plugins list table to display messages.
	 *
	 * @since 1.0.0
	 */
	public function plugin_row_notice() {
		?><tr class="active <?php echo esc_attr( $this->unmet_requirements_name() ); ?>-row">
		<th class="check-column">
			<span class="dashicons dashicons-warning"></span>
		</th>
		<td class="column-primary">
			<?php $this->unmet_requirements_text(); ?>
		</td>
		<td class="column-description">
			<?php $this->unmet_requirements_description(); ?>
		</td>
		</tr><?php
	}

	/**
	 * Outputs unmet requirement descriptions.
	 *
	 * @since 1.0.0
	 */
	private function unmet_requirements_description() {
		foreach ( $this->requirements as $properties ) {
			if ( empty( $properties['met'] ) ) {
				$this->unmet_requirement_description( $properties );
			}
		}
	}

	/**
	 * Outputs specific unmet requirement information.
	 *
	 * @since 1.0.0
	 *
	 * @param array $requirement Requirements.
	 */
	private function unmet_requirement_description( $requirement = array() ) {

		// Requirement exists, but is out of date
		if ( ! empty( $requirement['exists'] ) ) {
			$text = sprintf(
				$this->unmet_requirements_description_text(),
				'<strong>' . esc_html( $requirement['name']    ) . '</strong>',
				'<strong>' . esc_html( $requirement['minimum'] ) . '</strong>',
				'<strong>' . esc_html( $requirement['current'] ) . '</strong>'
			);

			// Requirement could not be found
		} else {
			$text = sprintf(
				$this->unmet_requirements_missing_text(),
				'<strong>' . esc_html( $requirement['name']    ) . '</strong>',
				'<strong>' . esc_html( $requirement['minimum'] ) . '</strong>'
			);
		}

		// Output the description
		echo '<p>' . $text . '</p>';
	}

	/**
	 * Outputs styling for unmet requirements in the plugins list table.
	 *
	 * @since 1.0.0
	 */
	public function admin_head() {

		// Get the requirements row name
		$name = $this->unmet_requirements_name(); ?>

		<style id="<?php echo esc_attr( $name ); ?>">
			.plugins tr[data-plugin="<?php echo esc_html( $this->base ); ?>"] th,
			.plugins tr[data-plugin="<?php echo esc_html( $this->base ); ?>"] td,
			.plugins .<?php echo esc_html( $name ); ?>-row th,
			.plugins .<?php echo esc_html( $name ); ?>-row td {
				background: #fff5f5;
			}
			.plugins tr[data-plugin="<?php echo esc_html( $this->base ); ?>"] th {
				box-shadow: none;
			}
			.plugins .<?php echo esc_html( $name ); ?>-row th span {
				margin-left: 6px;
				color: #dc3232;
			}
			.plugins tr[data-plugin="<?php echo esc_html( $this->base ); ?>"] th,
			.plugins .<?php echo esc_html( $name ); ?>-row th.check-column {
				border-left: 4px solid #dc3232 !important;
			}
			.plugins .<?php echo esc_html( $name ); ?>-row .column-description p {
				margin: 0;
				padding: 0;
			}
			.plugins .<?php echo esc_html( $name ); ?>-row .column-description p:not(:last-of-type) {
				margin-bottom: 8px;
			}
		</style>
		<?php
	}

	/**
	 * Adds the "Requirements" link to the plugin row actions.
	 *
	 * @since 1.0.0
	 *
	 * @param array $links Plugin row links.
	 * @return array Modified row links array.
	 */
	public function plugin_row_links( $links = array() ) {

		// Add the Requirements link
		$links['requirements'] =
			'<a href="' . esc_url( $this->unmet_requirements_url() ) . '" aria-label="' . esc_attr( $this->unmet_requirements_label() ) . '">'
			. esc_html( $this->unmet_requirements_link() )
			. '</a>';

		// Return links with Requirements link
		return $links;
	}

	/** Checkers **************************************************************/

	/**
	 * Runs the actual dependencies checks and compiles the findings.
	 *
	 * @since 1.0.0
	 */
	private function check() {

		// Loop through requirements
		foreach ( $this->requirements as $dependency => $properties ) {

			// Which dependency are we checking?
			switch ( $dependency ) {

				// PHP
				case 'php' :
					$version = phpversion();
					break;

				// WP
				case 'wp' :
					$version = get_bloginfo( 'version' );
					break;

				case 'affwp':
					$version = get_option( 'affwp_version' );
					break;

				// Unknown
				default :
					$version = false;
					break;
			}

			// Merge to original array
			if ( ! empty( $version ) ) {
				$this->requirements[ $dependency ] = array_merge( $this->requirements[ $dependency ], array(
					'current' => $version,
					'checked' => true,
					'met'     => version_compare( $version, $properties['minimum'], '>=' )
				) );
			}
		}
	}

	/**
	 * Determines if all requirements been met.
	 *
	 * @since 1.0.0
	 *
	 * @return bool True if requirements are met, otherwise false.
	 */
	public function met() {

		// Run the check
		$this->check();

		// Default to true (any false below wins).
		$retval  = true;
		$to_meet = wp_list_pluck( $this->requirements, 'met' );

		// Look for unmet dependencies, and exit if so
		foreach ( $to_meet as $met ) {
			if ( empty( $met ) ) {
				$retval = false;
				continue;
			}
		}

		// Return
		return $retval;
	}

	/** Translations **********************************************************/

	/**
	 * Loads the plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {

		// Set filter for plugin's languages directory.
		$lang_dir   = dirname( $this->base ) . '/languages/';
		$get_locale = function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();

		/**
		 * Defines the plugin language locale used in the addon.
		 *
		 * @var $get_locale The locale to use. Uses get_user_locale()` in WordPress 4.7 or greater,
		 *                  otherwise uses `get_locale()`.
		 */
		$locale = apply_filters( 'plugin_locale', $get_locale, 'affiliatewp-starting-affiliate-id' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'affiliatewp-starting-affiliate-id', $locale );

		// Look for wp-content/languages/affiliatewp-starting-affiliate-id-{lang}_{country}.mo
		$mofile_global1 = WP_LANG_DIR . "/affiliatewp-starting-affiliate-id-{$locale}.mo";

		// Look in wp-content/languages/plugins/affiliatewp-starting-affiliate-id
		$mofile_global2 = WP_LANG_DIR . "/plugins/affiliatewp-starting-affiliate-id/{$mofile}";

		// Try to load from first global location
		if ( file_exists( $mofile_global1 ) ) {
			load_textdomain( 'affiliatewp-starting-affiliate-id', $mofile_global1 );

		// Try to load from next global location
		} elseif ( file_exists( $mofile_global2 ) ) {
			load_textdomain( 'affiliatewp-starting-affiliate-id', $mofile_global2 );

		// Load the default language files
		} else {
			load_plugin_textdomain( 'affiliatewp-starting-affiliate-id', false, $lang_dir );
		}
	}

}

// Invoke the checker
new AffWP_SAI_Requirements_Check();
