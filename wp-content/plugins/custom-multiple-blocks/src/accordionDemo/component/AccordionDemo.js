import React from 'react';
import * as Accordion from '@radix-ui/react-accordion';
import classNames from 'classnames';
import { ChevronDownIcon } from '@radix-ui/react-icons';

const AccordionDemo = ({ attributes, content }) => {
	const { alignment, items } = attributes

	if (!items.length) {
		return null
	}

	return (
		<Accordion.Root className="AccordionRoot" type="single" defaultValue="item-1" collapsible>
			{ items.map((item, index) => {
				return (
					<Accordion.Item key={ index } className="AccordionItem" value={ `item-1${ index }` }>
						<AccordionTrigger>{ item.question }</AccordionTrigger>
						<AccordionContent>{ item.answer }</AccordionContent>
					</Accordion.Item>
				)
			}) }
		</Accordion.Root>
	);
}

export const AccordionTrigger = React.forwardRef(({ children, className, ...props }, forwardedRef) => (
	<Accordion.Header className="AccordionHeader">
		<Accordion.Trigger
			className={ classNames('AccordionTrigger', className) }
			{ ...props }
			ref={ forwardedRef }
		>
			{ children }
			<ChevronDownIcon className="AccordionChevron" aria-hidden />
		</Accordion.Trigger>
	</Accordion.Header>
));

export const AccordionContent = React.forwardRef(({ children, className, ...props }, forwardedRef) => (
	<Accordion.Content
		className={ classNames('AccordionContent', className) }
		{ ...props }
		ref={ forwardedRef }
	>
		<div className="AccordionContentText">{ children }</div>
	</Accordion.Content>
));

export default AccordionDemo;
