import { InnerBlocks } from '@wordpress/block-editor'
import { registerBlockType } from '@wordpress/blocks';
import './style.scss';

import Edit from './edit';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit: Edit,
	save: Save
} );

function Save() {
  return <InnerBlocks.Content />
}
