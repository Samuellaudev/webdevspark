import { TextControl, Button } from '@wordpress/components'
import { useBlockProps, BlockControls, AlignmentToolbar } from '@wordpress/block-editor'
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { alignment } = attributes;

	const blockProps = useBlockProps()

	return (
		<div { ...blockProps }>
			<BlockControls>
				<AlignmentToolbar
					value={ alignment }
					onChange={ position => setAttributes({ alignment: position }) }
				/>
			</BlockControls>
			<p>navigation menu demo</p>
		</div>
	);
}
