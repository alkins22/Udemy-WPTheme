import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, PanelColorSettings, InspectorControls } from '@wordpress/block-editor';
import { __ } from "@wordpress/i18n"
import block from './block.json';
import icons from '../../icons.js';
import './main.css';


registerBlockType(block.name, {
    icon: icons.primary,
    edit({ attributes, setAttributes }) {
        const { bgColor, textColor } = attributes
        const blockProps = useBlockProps({
            style: {
                'background-color': bgColor,
                color: textColor
            }
        })

        return (
            <> 
            <InspectorControls>
                <PanelColorSettings
                    title={__('Colors', 'udemy-plus')}
                    colorSettings={[
                        { 
                            label: __('Background Color', 'udemy-plus'),
                            value: bgColor,
                            onChange: newVal => setAttributes({ bgColor: newVal })
                        },
                        {
                            label: __('Text Color', 'udemy-plus'),
                            value: textColor,
                            onChange: newVal => setAttributes({ textColor: newVal })
                        }
                    ]}
                />
            </InspectorControls>
            <div {...blockProps}>
                <h1>Search: Your search term here</h1>
                <form>
                  <input type="text" placeholder="Search"/>
                  <div className="btn-wrapper">
                    <button type="submit" style={{
                        'background-color': bgColor,
                        color: textColor
                    }}>Search</button>
                  </div>
                </form>
              </div>
            </>

        )
    },

    // save({ attributes }) {
    //     const { bgColor, textColor } = attributes
    //     const blockProps = useBlockProps.save({
    //         className: 'search-form',
    //         style: {
    //             'background-color': `${bgColor}`,
    //             'text-color': `${textColor}`
    //         }
    //     })


    //     return (
    //         <div {...blockProps} className="search-form">
    //             <h1>Search: Your search term here</h1>
    //             <form>
    //                 <input type="text" placeholder="Search"/>
    //                 <div className="btn-wrapper">
    //                     <button type="submit">Search</button>
    //                 </div>
    //             </form>
    //       </div>
    //     )
})