import React from 'react';
import * as NavigationMenu from '@radix-ui/react-navigation-menu';
import classNames from 'classnames';
import { CaretDownIcon } from '@radix-ui/react-icons';

const NavigationMenuDemo = ({ attributes, content }) => {
	const { alignment, items } = attributes

	return (
		<NavigationMenu.Root className="NavigationMenuRoot">
			<NavigationMenu.List className="NavigationMenuList">
				{ items.map(item => (
					<NavigationMenu.Item>
						<NavigationMenu.Trigger className="NavigationMenuTrigger">
							{ item.itemTitle } <CaretDownIcon className="CaretDown" aria-hidden />
						</NavigationMenu.Trigger>
						<NavigationMenu.Content className="NavigationMenuContent">
							{ item.itemContent.map((subItem) => (
								<ul className="List one">
									<ListItem href="#" title={ subItem.subItemTitle }>
										{ subItem.subItemContent }
									</ListItem>
								</ul>
							)) }
						</NavigationMenu.Content>
					</NavigationMenu.Item>
				)) }

				<NavigationMenu.Indicator className="NavigationMenuIndicator">
					<div className="Arrow" />
				</NavigationMenu.Indicator>
			</NavigationMenu.List>

			<div className="ViewportPosition">
				<NavigationMenu.Viewport className="NavigationMenuViewport" />
			</div>
		</NavigationMenu.Root>
	);
};

export const ListItem = React.forwardRef(({ className, children, title, ...props }, forwardedRef) => (
	<li>
		<NavigationMenu.Link asChild>
			<a className={ classNames('ListItemLink', className) } { ...props } ref={ forwardedRef }>
				<div className="ListItemHeading">{ title }</div>
				<p className="ListItemText">{ children }</p>
			</a>
		</NavigationMenu.Link>
	</li>
));

export default NavigationMenuDemo;

