// jQuery UI style "widget" for editing an iTop "dashboard"
$(function()
{
	// the widget definition, where "itop" is the namespace,
	// "dashboard" the widget name
	$.widget( "itop.dashboard",
	{
		// default options
		options:
		{
			dashboard_id: '',
			layout_class: '',
			title: '',
			submit_to: 'index.php',
			submit_parameters: {},
			render_to: 'index.php',
			render_parameters: {},
			new_dashlet_parameters: {}
		},
	
		// the constructor
		_create: function()
		{
			var me = this; 

			this.element
			.addClass('itop-dashboard');

			this.ajax_div = $('<div></div>').appendTo(this.element);
			this._make_draggable();
		},
	
		// called when created, and later when changing options
		_refresh: function()
		{
			var oParams = this._get_state(this.options.render_parameters);
			var me = this;
			$.post(this.options.render_to, oParams, function(data){
				me.element.html(data);
				me._make_draggable();
			});
		},
		// events bound via _bind are removed automatically
		// revert other modifications here
		destroy: function()
		{
			this.element
			.removeClass('itop-dashboard');

			this.ajax_div.remove();
			$(document).unbind('keyup.dashboard_editor');
			
			// call the original destroy method since we overwrote it
			$.Widget.prototype.destroy.call( this );			
		},
		// _setOptions is called with a hash of all options that are changing
		_setOptions: function()
		{
			// in 1.9 would use _superApply
			$.Widget.prototype._setOptions.apply( this, arguments );
			this._refresh();
		},
		// _setOption is called for each individual option that is changing
		_setOption: function( key, value )
		{
			// in 1.9 would use _super
			$.Widget.prototype._setOption.call( this, key, value );
		},
		_get_state: function(oMergeInto)
		{
			var oState = oMergeInto;
			oState.cells = [];
			this.element.find('.layout_cell').each(function() {
				var aList = [];
				$(this).find(':itop-dashlet').each(function() {
					var oDashlet = $(this).data('dashlet');
					if(oDashlet)
					{
						var oDashletParams = oDashlet.get_params();
						var sId = oDashletParams.dashlet_id;
						oState[sId] = oDashletParams;				
						aList.push({dashlet_id: sId, dashlet_class: oDashletParams.dashlet_class} );
					}
				});
				
				if (aList.length == 0)
				{
					oState[0] = {dashlet_id: 0, dashlet_class: 'DashletEmptyCell'};
					aList.push({dashlet_id: 0, dashlet_class: 'DashletEmptyCell'});
				}
				oState.cells.push(aList);
			});
			oState.dashboard_id = this.options.dashboard_id;
			oState.layout_class = this.options.layout_class;
			oState.title = this.options.title;
			
			return oState;
		},
		save: function()
		{
			var oParams = this._get_state(this.options.submit_parameters);
			var me = this;
			$.post(this.options.submit_to, oParams, function(data){
				me.ajax_div.html(data);
			});
		},
		add_dashlet: function(options)
		{
			var sDashletId = this._get_new_id();
			var oDashlet = $('<div class="dashlet" id="dashlet_'+sDashletId+'"/>');
			oDashlet.appendTo(options.container);
			var oDashletProperties = $('<div class="dashlet_properties" id="dashlet_properties_'+sDashletId+'"/>');
			oDashletProperties.appendTo($('#dashlet_properties'));
			
			var oParams = this.options.new_dashlet_parameters;
			var sDashletClass = options.dashlet_class;
			oParams.dashlet_class = sDashletClass;
			oParams.dashlet_id = sDashletId;
			var me = this;
			$.post(this.options.render_to, oParams, function(data){
				me.ajax_div.html(data);
				$('#dashlet_'+sDashletId)
				.dashlet({dashlet_id: sDashletId, dashlet_class: sDashletClass})
				.dashlet('deselect_all')
				.dashlet('select')
				.draggable({
					revert: 'invalid', appendTo: 'body', zIndex: 9999,
					helper: function() {
						var oDragItem = $(this).dashlet('get_drag_icon');
						return oDragItem;
					},
					cursorAt: { top: 16, left: 16 },
				});
				if (options.refresh)
				{
					me._refresh();
				}
			});
		},
		_get_new_id: function()
		{
			var iMaxId = 0;
			this.element.find(':itop-dashlet').each(function() {
				var oDashlet = $(this).data('dashlet');
				if(oDashlet)
				{
					var oDashletParams = oDashlet.get_params();
					var id = parseInt(oDashletParams.dashlet_id, 10);
					if (id > iMaxId) iMaxId = id;
				}
			});
			return 1 + iMaxId;			
		},
		_make_draggable: function()
		{
			var me = this;
			this.element.find('.dashlet').draggable({
				revert: 'invalid', appendTo: 'body', zIndex: 9999,
				helper: function() {
					var oDragItem = $(this).dashlet('get_drag_icon');
					return oDragItem;
				},
				cursorAt: { top: 16, left: 16 },
			});
			this.element.find('table td').droppable({
				accept: '.dashlet,.dashlet_icon',
				drop: function(event, ui) {
					$( this ).find( ".placeholder" ).remove();
					var bRefresh = $(this).hasClass('layout_extension');
					var oDashlet = ui.draggable;
					if (oDashlet.hasClass('dashlet'))
					{
						// moving around a dashlet
						oDashlet.detach();
						oDashlet.css({top: 0, left: 0});
						oDashlet.appendTo($(this));
						if( bRefresh )
						{
							// The layout was extended... refresh the whole dashboard
							me._refresh();
						}
					}
					else
					{
						// inserting a new dashlet
						var sDashletClass = ui.draggable.attr('dashlet_class');
						$(':itop-dashboard').dashboard('add_dashlet', {dashlet_class: sDashletClass, container: $(this), refresh: bRefresh });
					}
				},
			});	
		}
	});	
});