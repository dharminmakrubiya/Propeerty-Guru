<?php

/**
 * HTML code for the Add New/Edit Snippet page
 *
 * @package    Code_Snippets
 * @subpackage Views
 *
 * @var Code_Snippets_Edit_Menu $this
 */

/* Bail if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

$snippet = $this->snippet;
$classes = array();

if ( ! $snippet->id ) {
	$classes[] = 'new-snippet';
} elseif ( 'single-use' === $snippet->scope ) {
	$classes[] = 'single-use-snippet';
} else {
	$classes[] = ( $snippet->active ? '' : 'in' ) . 'active-snippet';
}

?>
<div class="wrap">
	<h1>
		<?php

		if ( $snippet->id ) {
			esc_html_e( 'Edit Snippet', 'code-snippets' );
			printf( ' <a href="%1$s" class="page-title-action add-new-h2">%2$s</a>',
				esc_url( code_snippets()->get_menu_url( 'add' ) ),
				esc_html_x( 'Add New', 'snippet', 'code-snippets' )
			);
		} else {
			esc_html_e( 'Add New Snippet', 'code-snippets' );
		}

		$admin = code_snippets()->admin;

		if ( code_snippets()->admin->is_compact_menu() ) {

			printf( '<a href="%2$s" class="page-title-action">%1$s</a>',
				esc_html_x( 'Manage', 'snippets', 'code-snippets' ),
				esc_url( code_snippets()->get_menu_url() )
			);

			printf( '<a href="%2$s" class="page-title-action">%1$s</a>',
				esc_html_x( 'Import', 'snippets', 'code-snippets' ),
				esc_url( code_snippets()->get_menu_url( 'import' ) )
			);

			if ( isset( $admin->menus['settings'] ) ) {

				printf( '<a href="%2$s" class="page-title-action">%1$s</a>',
					esc_html_x( 'Settings', 'snippets', 'code-snippets' ),
					esc_url( code_snippets()->get_menu_url( 'settings' ) )
				);
			}
		}

		?>
	</h1>

	<form method="post" id="snippet-form" action="" style="margin-top: 10px;"
	      class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php
		/* Output the hidden fields */

		if ( 0 !== $snippet->id ) {
			printf( '<input type="hidden" name="snippet_id" value="%d">', esc_attr( $snippet->id ) );
		}

		printf( '<input type="hidden" name="snippet_active" value="%d">', esc_attr( $snippet->active ) );

		do_action( 'code_snippets/admin/before_title_input', $snippet );
		?>

		<div id="titlediv">
			<div id="titlewrap">
				<label for="title" style="display: none;"><?php esc_html_e( 'Name', 'code-snippets' ); ?></label>
				<input id="title" type="text" autocomplete="off" name="snippet_name"
				       value="<?php echo esc_attr( $snippet->name ); ?>"
				       placeholder="<?php esc_html_e( 'Enter title here', 'code-snippets' ); ?>">
			</div>
		</div>

		<?php do_action( 'code_snippets/admin/after_title_input', $snippet ); ?>

		<p class="submit-inline"><?php do_action( 'code_snippets/admin/code_editor_toolbar', $snippet ); ?></p>

		<h2><label for="snippet_code"><?php esc_html_e( 'Code', 'code-snippets' ); ?></label></h2>

		<div class="snippet-editor">
			<textarea id="snippet_code" name="snippet_code" rows="200" spellcheck="false"
			          style="font-family: monospace; width: 100%;"><?php echo esc_textarea( $snippet->code ); ?></textarea>

			<div class="snippet-editor-help">

				<div class="editor-help-tooltip cm-s-<?php
				echo esc_attr( code_snippets_get_setting( 'editor', 'theme' ) ); ?>"><?php
					echo esc_html_x( '?', 'help tooltip', 'code-snippets' ); ?></div>

				<div class="editor-help-text">
					<table>
						<tr>
							<td><?php esc_html_e( 'Save changes', 'code-snippets' ); ?></td>
							<td><?php $this->render_keyboard_shortcut( 'Cmd', 'S' ); ?></td>
						</tr>
						<tr>
							<td><?php esc_html_e( 'Begin searching', 'code-snippets' ); ?></td>
							<td><?php $this->render_keyboard_shortcut( 'Cmd', 'F' ); ?></td>
						</tr>
						<tr>
							<td><?php esc_html_e( 'Find next', 'code-snippets' ); ?></td>
							<td><?php $this->render_keyboard_shortcut( 'Cmd', 'G' ); ?></td>
						</tr>
						<tr>
							<td><?php esc_html_e( 'Find previous', 'code-snippets' ); ?></td>
							<td><?php $this->render_keyboard_shortcut( array( 'Shift', 'Cmd' ), 'G' ); ?></td>
						</tr>
						<tr>
							<td><?php esc_html_e( 'Replace', 'code-snippets' ); ?></td>
							<td><?php $this->render_keyboard_shortcut( array( 'Shift', 'Cmd' ), 'F' ); ?></td>
						</tr>
						<tr>
							<td><?php esc_html_e( 'Replace all', 'code-snippets' ); ?></td>
							<td><?php $this->render_keyboard_shortcut( array( 'Shift', 'Cmd', 'Option' ), 'R' ); ?></td>
						</tr>
						<tr>
							<td><?php esc_html_e( 'Persistent search', 'code-snippets' ); ?></td>
							<td><?php $this->render_keyboard_shortcut( 'Alt', 'F' ); ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<?php
		/* Allow plugins to add fields and content to this page */
		do_action( 'code_snippets/admin/single', $snippet );

		/* Add a nonce for security */
		wp_nonce_field( 'save_snippet' );

		?>

		<p class="submit"><?php $this->render_submit_buttons( $snippet ); ?></p>
	</form>
</div>
