import { __ } from '@wordpress/i18n';
import { Fragment, useState } from '@wordpress/element';
import { InnerBlocks } from "@wordpress/block-editor";

import './editor.scss';

/**
 * 1 - Toggle dalna ha Default Open ka
 */

function Edit(props) {
	const [ contentVisibillity, setContentVisibillity ] = useState(false);

	return (
		<Fragment>
			<div className="cwp_toggle_wrapper">
				<button onClick={() => setContentVisibillity(!contentVisibillity)}>Click ME</button>
				{contentVisibillity && (
					<div className="cwp_toggle_content">
						<InnerBlocks />
					</div>
				)}
			</div>
		</Fragment>
	);
}

export default Edit;
