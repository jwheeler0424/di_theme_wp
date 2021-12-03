/**
 *  @package diPlugin
*/
const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;

/*
    ##################################################
    |   CUSTOM GUTENBURG BLOCK - DL, DT, DD          |
    ##################################################
*/

registerBlockType( 'di/faq', {

    // Built-in Attributes
    title: 'Frequently Asked Question',
    description: 'Create a FAQ Block with a question and answer.',
    icon: 'excerpt-view',
    category: 'common',

    // Custom Attributes
    attributes: {
        question: {
            type: 'string',
            source: 'html',
            selector: 'dt'
        },
        answer: {
            type: 'string',
            source: 'html',
            selector: 'dd'
        }
    },

    // Built-in Functions
    edit( { attributes: { question, answer }, setAttributes } ) {

        return (

            <>
                <RichText tagName="dt"
                          placeholder="Question"
                          value={ question }
                          onChange={ ( question ) => { setAttributes( { question } ); } }
                          style={ {fontWeight: 700} }
                />
                <RichText tagName="dd"
                          placeholder="Answer"
                          value={ answer }
                          onChange={ ( answer ) => { setAttributes( { answer } ); } }
                />
            </>

        );
    },

    save( { attributes: { question, answer } } ) {

        return (
            <>
                <RichText.Content tagName="dt"
                          value={ question }
                />
                <RichText.Content tagName="dd"
                          value={ answer }
                />
            </>
        );
        
    }
    
});