import { useEffect } from 'react';
import {
	TextControl,
	Button,
	Card,
	CardHeader,
	CardBody,
	CardDivider,
} from '@wordpress/components';
import {
	useBlockProps,
	BlockControls,
	AlignmentToolbar,
} from '@wordpress/block-editor';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { alignment, items = [] } = attributes;

	useEffect(() => {
		if (items.length === 0) {
			setAttributes({
				items: [
					{
						itemTitle: '',
						itemContent: [
							{
								subItemTitle: '',
								subItemContent: '',
							},
						],
					},
				],
			});
		}
	}, [items, setAttributes]);

	const blockProps = useBlockProps();

	const updateItemTitle = (newValue, index) => {
		const updatedItems = [...items];
		updatedItems[index].itemTitle = newValue;
		setAttributes({ items: updatedItems });
	};

	const updateSubItemTitle = (newValue, index, subIndex) => {
		const updatedItems = [...items];
		updatedItems[index].itemContent[subIndex].subItemTitle = newValue;
		setAttributes({ items: updatedItems });
	};

	const updateSubItemContent = (newValue, index, subIndex) => {
		const updatedItems = [...items];
		updatedItems[index].itemContent[subIndex].subItemContent = newValue;
		setAttributes({ items: updatedItems });
	};

	const addItem = () => {
		const newItem = {
			itemTitle: '',
			itemContent: [
				{
					subItemTitle: '',
					subItemContent: '',
				},
			],
		};
		setAttributes({ items: [...items, newItem] });
	};

	const addSubItem = (index) => {
		const updatedItems = [...items];
		const newSubItem = {
			subItemTitle: '',
			subItemContent: '',
		};
		updatedItems[index].itemContent = [
			...updatedItems[index].itemContent,
			newSubItem,
		];
		setAttributes({ items: updatedItems });
	};

	const deleteItem = (index) => {
		const updatedItems = items.filter((_, i) => i !== index);
		setAttributes({ items: updatedItems });
	};

	const deleteSubItem = (index, subIndex) => {
		const updatedItems = [...items];
		updatedItems[index].itemContent = updatedItems[index].itemContent.filter(
			(_, i) => i !== subIndex
		);
		setAttributes({ items: updatedItems });
	};

	const displaySubItems = (subItems, index) =>
		subItems.map((subItem, subIndex) => (
			<div key={ `subItem-${ index }-${ subIndex }` } className='subItem-body'>
				<TextControl
					label={ `Enter title for sub-menu item ${ subIndex + 1 }` }
					value={ subItem.subItemTitle }
					onChange={ (newValue) => updateSubItemTitle(newValue, index, subIndex) }
				/>
				<TextControl
					label={ `Enter content for sub-menu item ${ subIndex + 1 }` }
					value={ subItem.subItemContent }
					onChange={ (newValue) =>
						updateSubItemContent(newValue, index, subIndex)
					}
				/>
				<Button isDestructive className="delete-subitem" onClick={ () => deleteSubItem(index, subIndex) }>
					Delete sub-item
				</Button>
			</div>
		));

	const displayItems = () =>
		items.map((item, index) => (
			<div key={ `item-${ index }` }>
				<Card className="menu-item">
					<CardHeader>
						<TextControl
							label={ `Enter title for menu item ${ index + 1 }` }
							value={ item.itemTitle }
							onChange={ (newValue) => updateItemTitle(newValue, index) }
						/>
					</CardHeader>
					<CardBody className="submenu-item">
						{ displaySubItems(item.itemContent, index) }
						<Button isPrimary className="add-subitem" onClick={ () => addSubItem(index) }>
							Add another sub-item
						</Button>
					</CardBody>
					<Button
						isDestructive
						className="delete-item"
						onClick={ () => deleteItem(index) }
					>
						Delete item
					</Button>
				</Card>
				{ items.length > 1 && <CardDivider /> }
			</div>
		));

	return (
		<div { ...blockProps }>
			<BlockControls>
				<AlignmentToolbar
					value={ alignment }
					onChange={ (position) => setAttributes({ alignment: position }) }
				/>
			</BlockControls>
			<div className="NavigationMenuRoot">
				{ displayItems() }
				<Button isPrimary className="add-item" onClick={ addItem }>
					Add another item
				</Button>
			</div>
		</div>
	);
}
