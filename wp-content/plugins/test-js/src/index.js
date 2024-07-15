import { TextControl, Flex, FlexBlock, FlexItem, Button, Icon } from '@wordpress/components'
import './index.scss'

wp.blocks.registerBlockType('js-plugin/test-js-plugin', {
  title: 'Test JS Plugin',
  icon: 'smiley',
  category: 'common',
  attributes: {
    question: { type: "string" },
    answers: { type: "array", default: ["red", "green", "blue"] }
  },
  edit: EditComponent,
  save: ({ attributes }) => {
    return (
      <>
        <p>Sky color is <span className='skyColor'>{ attributes.skyColor }</span></p>
        <p>Grass color is <span className='grassColor'>{ attributes.grassColor }</span></p>
      </>
    )
  }
})

function EditComponent({ attributes, setAttributes }) {
  const updateQuestion = (value) => {
    setAttributes({ question: value })
  }

  const updateAnswer = (newValue, index) => {
    const newAnswer = [...attributes.answers]
    newAnswer[index] = newValue
    setAttributes({ answers: newAnswer })
  }

  const addAnswer = () => {
    setAttributes({ answers: [...attributes.answers, ''] })
  }

  const deleteAnswer = (answer) => {
    console.log(answer);
    const filteredAnswers = [...attributes.answers].filter(item => item !== answer)
    setAttributes({ answers: filteredAnswers })
  }

  return (
    <div className="test-js-plugin">
      <TextControl
        label="Question:"
        value={ attributes.question }
        onChange={ updateQuestion }
      />
      <p>Answers:</p>
      { attributes.answers.map((answer, index) => {
        return (
          <Flex>
            <FlexBlock>
              <TextControl
                autoFocus={ answer === '' }
                value={ answer }
                onChange={ (newValue) => updateAnswer(newValue, index) } 
              />
            </FlexBlock>
            <Button></Button>
            <FlexItem>
              <Icon className="mark-as-correct" icon='star-empty' />
            </FlexItem>
            <FlexItem>
              <Button
                isLink
                className="attention-delete"
                onClick={ () => deleteAnswer(answer) }
              >
                Delete
              </Button>
            </FlexItem>
          </Flex>
        )
      }) }
      <Button
        isPrimary
        className='add-answer'
        onClick={ addAnswer }>Add another answer</Button>
    </div>
  )
}