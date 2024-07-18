import * as HoverCard from '@radix-ui/react-hover-card';

const HoverCardDemo = (data) => {
	const { alignment, mainText, accountName, accountLink } = data.attributes
	const imgElement = data.content

	const extractSrcFromHTML = (html) => {
		const match = html.match(/src="([^"]*)"/);
		return match ? match[1] : '';
	};

	const srcValue = extractSrcFromHTML(imgElement);

	return (
		<HoverCard.Root>
			<HoverCard.Trigger asChild>
				<a
					className="ImageTrigger"
					href="https://twitter.com/radix_ui"
					target="_blank"
					rel="noreferrer noopener"
				>
					<img
						className="Image normal"
						src={ srcValue }
						alt="Radix UI"
					/>
				</a>
			</HoverCard.Trigger>
			<HoverCard.Portal>
				<HoverCard.Content className="HoverCardContent" sideOffset={ 5 }>
					<div style={ { display: 'flex', flexDirection: 'column', gap: 7, textAlign: alignment } }>
						<img
							className="Image large"
							src={ srcValue }
							alt="Radix UI"
						/>
						<div style={ { display: 'flex', flexDirection: 'column', gap: 15 } }>
							<div>
								<div className="Text bold">{ accountName }</div>
								<div className="Text faded">{ accountLink }</div>
							</div>
							<div className="Text">
								{ mainText }
							</div>
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
					<HoverCard.Arrow className="HoverCardArrow" />
				</HoverCard.Content>
			</HoverCard.Portal>
		</HoverCard.Root>
	)
}


export default HoverCardDemo;
