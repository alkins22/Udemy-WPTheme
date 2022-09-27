import { registerBlockType } from '@wordpress/blocks';
import { 
  RichText,
  useBlockProps,
  InspectorControls
} from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import block from './block.json';
import { __ } from '@wordpress/i18n';
import icons from '../../icons.js'
import './main.css'

registerBlockType('udemy-plus/page-header', {
  icon: icons.primary,
	edit({ attributes, setAttributes }) {
    const { content, showCategory } = attributes
    const blockProps = useBlockProps();

    return (
      <>
      <InspectorControls>
        <PanelBody title={__('General', 'udemy-plus')}>
          <ToggleControl 
            label={__('Show Category', 'udemy-plus')}
            checked={showCategory}
            onChange={newVal => setAttributes({showCategory: newVal})}
            help={
              showCategory ? 
              __('Category Shown', 'udemy-plus') : 
              __('Use a custom header', 'udemy-plus')
            }
          />
        </PanelBody>
      </InspectorControls>
        <div {...blockProps}>
          <div className="inner-page-header">
            {
              showCategory ? 
              <h1>{__('Category: Some Category', 'udemy-plus')}</h1> :
              <RichText
              tagName='h1'
              placeholder={__("Heading", "udemy-plus")}
              value={content}
              onChange={content => setAttributes({ content })}
            />
           } 
          </div>
        </div>
      </>
    );
  },

  save({ attributes }) {
    const { content } = attributes
    const blockProps = useBlockProps.save({
      className: 'page-header'
  })

    return (
      <RichText.Content 
          {...blockProps}
          tagName="h1"
          value={content}
      />
  );
  }
});
