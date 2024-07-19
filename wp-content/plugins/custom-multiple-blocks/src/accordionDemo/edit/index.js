import { TextControl, Button } from '@wordpress/components'
import { useBlockProps, BlockControls, AlignmentToolbar } from '@wordpress/block-editor'
import * as Accordion from '@radix-ui/react-accordion';
import { AccordionTrigger, AccordionContent } from '../component/AccordionDemo';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { alignment, items } = attributes;

	if (!items || items.length === 0) {
		setAttributes({
			items: [
				{ question: '', answer: '' },
			],
		});
	}

	const blockProps = useBlockProps()

	const updateQuestion = (newValue, index) => {
		const newItems = [...items];
		newItems[index].question = newValue;
		setAttributes({ items: newItems });
	};

	const updateAnswer = (newValue, index) => {
		const newItems = [...items];
		newItems[index].answer = newValue;
		setAttributes({ items: newItems });
	}

	const addItem = () => {
		const newItem = {
			question: '',
			answer: ''
		}
		setAttributes({ items: [...items, newItem] })
	}

	const deleteItem = (indexToDelete) => {
		const filteredItems = [...items].filter((_, i) => i !== indexToDelete)
		setAttributes({ items: filteredItems })
	}

	return (
		<div { ...blockProps }>
			<BlockControls>
				<AlignmentToolbar
					value={ alignment }
					onChange={ position => setAttributes({ alignment: position }) }
				/>
			</BlockControls>
			<Accordion.Root className="AccordionRoot" type="single" defaultValue="item-1" collapsible>
				{ items?.map((item, index) => {
					return (
						<Accordion.Item key={ index } className="AccordionItem" value={ `item-1${ index }` }>
							<div>
								<AccordionTrigger>
									<TextControl
										label="Enter question text"
										value={ item?.question }
										onChange={ (newValue) => updateQuestion(newValue, index) }
									/>
								</AccordionTrigger>
								<AccordionContent>
									<TextControl
										label="Enter answer text"
										value={ item?.answer }
										onChange={ (newValue) => updateAnswer(newValue, index) }
									/>
								</AccordionContent>
							</div>
							<Button
								isLink
								className="AccordionDelete"
								onClick={ () => deleteItem(index) }
							>
								Delete
							</Button>
						</Accordion.Item>
					)
				}) }
				<Button
					isPrimary
					className='AccordionAdd'
					onClick={ addItem }>Add another item
				</Button>
			</Accordion.Root>
		</div>
	);
}
