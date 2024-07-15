import { TextControl, Flex, FlexBlock, FlexItem, Button, Icon, PanelBody, PanelRow, ColorPicker } from '@wordpress/components'
import { InspectorControls, BlockControls, AlignmentToolbar } from '@wordpress/block-editor'
import { ChromePicker } from 'react-color'
import './index.scss'

(() => {
  let locked = false

  wp.data.subscribe(() => {
    const results = wp.data.select('core/block-editor').getBlocks().filter((block) => {
      const checkBlockName = block.name === 'js-plugin/test-js-plugin'
      const checkIfCorrectAnswer = block.attributes.correctAnswer === undefined

      return checkBlockName && checkIfCorrectAnswer
    })

    if (results.length && locked === false) {
      locked = true
      wp.data.dispatch('core/editor').lockPostSaving('noanswer')
    }

    if (!results.length && locked) {
      locked = false
      wp.data.dispatch('core/editor').unlockPostSaving('noanswer')
    }
  })
})()

wp.blocks.registerBlockType('js-plugin/test-js-plugin', {
  title: 'Test JS Plugin',
  icon: 'smiley',
  category: 'common',
  attributes: {
    question: { type: "string" },
    answers: { type: "array", default: ["redd", "green", "blue"] },
    correctAnswer: { type: 'number', default: undefined },
    bgColor: { type: "string", default: '#EBEBEB' },
    alignment: { type: "string", default: 'left' }
  },
  description: "Here's some description about the plugin",
  example: {
    attributes: {
      question: 'What is my name?',
      answers: ['Samuel', 'Meowsalot', 'Barksalot'],
      correctAnswer: 3,
      bgColor: '#CFE8F1',
      alignment: 'center'
    }
  },  
  edit: EditComponent,
  save: ({ attributes }) => {
    return null
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

  const deleteAnswer = (answer, indexToDelete) => {
    const filteredAnswers = [...attributes.answers].filter(item => item !== answer)
    setAttributes({ answers: filteredAnswers })

    if (indexToDelete === attributes.correctAnswer) {
      setAttributes({ correctAnswer: undefined })
    }
  }

  const markAsCorrect = (index) => {
    setAttributes({ correctAnswer: index })
  }

  return (
    <div
      className="paying-attention-edit-block"
      style={ { backgroundColor: attributes.bgColor } }
    >
      <BlockControls>
        <AlignmentToolbar
          value={ attributes.alignment }
          onChange={ position => setAttributes({ alignment: position }) }
        />
      </BlockControls>
      <InspectorControls>
        <PanelBody title='Background Color' initialOpen>
          <PanelRow>
            <ChromePicker
              disableAlpha
              color={ attributes.bgColor }
              onChangeComplete={ color => setAttributes({ bgColor: color.hex }) }
            />
          </PanelRow>
        </PanelBody>
      </InspectorControls>
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
            <FlexItem>
              <Button
                onClick={ () => markAsCorrect(index) }
              >
                <Icon className="mark-as-correct" icon={ attributes.correctAnswer == index ? 'star-filled' : 'star-empty' } />
              </Button>
            </FlexItem>
            <FlexItem>
              <Button
                isLink
                className="attention-delete"
                onClick={ () => deleteAnswer(answer, index) }
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