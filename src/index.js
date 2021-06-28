/* global NelioContent */

const { _x } = wp.i18n;
const { registerQualityCheck } = NelioContent.editPost;

registerQualityCheck( 'customizations/spanish', {
	icon: 'translation',
	attributes: ( select ) => {
		const { getContent } = select( 'nelio-content/edit-post' );
		return { content: getContent() };
	},
	validate: ( { content } ) => {
		const spanishWords =
			content.match( /\bde\b|\blado\b|\bpuede\b|\btambién\b/g ) || [];
		if ( spanishWords.length >= 10 ) {
			return {
				status: 'bad',
				text: _x(
					'Spanish content detected',
					'text',
					'customizations'
				),
			};
		} //end if

		return {
			status: 'good',
			text: _x( 'No Spanish content detected', 'text', 'customizations' ),
		};
	},
} );
