// editor/index.js

import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { metaFields } from './components/metaFields';
import { useSelect, useDispatch } from '@wordpress/data';
import { useCallback } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { renderControl, renderImageControls } from './components/renderControl';

const ProjectMetaPanel = () => {

	const { editPost } = useDispatch('core/editor');

	const meta = useSelect((select) =>
		select('core/editor').getEditedPostAttribute('meta') || {}
	);	

	const updateMeta = useCallback((key, value) => {
		const newMeta = { ...meta, [key]: value };
		editPost({ meta: newMeta });
	}, [meta, editPost]);
	
	return (
		<PluginDocumentSettingPanel
			title={ __('Project Details', 'projects-case-studies')}
			name="project-details-sidebar"
			className="project-meta-sidebar"
		>
			{metaFields.map( (field) => renderControl( field, meta, updateMeta ) ) }
			{renderImageControls( meta, updateMeta ) }
		</PluginDocumentSettingPanel>
	);
};

registerPlugin('project-meta-sidebar', {
	render: ProjectMetaPanel,
	icon: 'admin-post',
});
