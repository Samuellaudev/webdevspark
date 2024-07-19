import { TextControl, TextareaControl, Placeholder } from '@wordpress/components'
import { useBlockProps, InnerBlocks, BlockControls, AlignmentToolbar } from '@wordpress/block-editor'
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { mainText, alignment, accountName, accountLink } = attributes;

	const allowedBlocks = [
		'core/image'
	]

	const blockProps = useBlockProps()

	const updateMainText = text => {
		setAttributes({ mainText: text })
	}
	const updateAccountName = text => {
		setAttributes({ accountName: text })
	}
	const updateAccountLink = text => {
		setAttributes({ accountLink: text })
	}

	return (
		<div { ...blockProps }>
			<BlockControls>
				<AlignmentToolbar
					value={ alignment }
					onChange={ position => setAttributes({ alignment: position }) }
				/>
			</BlockControls>
			<Placeholder label="Click to Add an image">
				<InnerBlocks allowedBlocks={ allowedBlocks } />
			</Placeholder>
			<div style={ { display: 'flex', flexDirection: 'column', gap: 7 } }>
				<div style={ { display: 'flex', flexDirection: 'column', gap: 15 } }>
					<TextControl
						label="Enter the account name here"
						className='Text'
						value={ accountName }
						onChange={ updateAccountName }
					/>
					<TextControl
						label="Enter the account link here"
						className='Text'
						value={ accountLink }
						onChange={ updateAccountLink }
					/>
					<TextareaControl
						label="Enter the main text here"
						className='Text'
						value={ mainText }
						onChange={ updateMainText }
					/>
					<div style={ { display: 'flex', gap: 15 } }>
						<div style={ { display: 'flex', gap: 5 } }>
							<div className="Text bold">0</div> <div className="Text faded">Following</div>
						</div>
						<div style={ { display: 'flex', gap: 5 } }>
							<div className="Text bold">2,900</div> <div className="Text faded">Followers</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	);
}
