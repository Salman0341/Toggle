import { __ } from '@wordpress/i18n';
import { InnerBlocks } from '@wordpress/block-editor';

function save(props) {
	return (
		<div className="cwp_toggle_wrapper">
			<button>Click ME</button>
			<div className="cwp_toggle_content">
				<InnerBlocks.Content />
			</div>
		</div>
	);
}

export default save;
