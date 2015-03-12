BR = BR || {};

BR.admin = {
	init: function(){
		$(".tab-pane .save").click(function(){
			BR.admin.savePage($(this).attr("data-page"));
		});

		$(".tab-pane h5 button.delete").click(function(){
			BR.admin.removeField(this);
		});
	},
	savePage: function(page){
		var fields = $("#"+page+" textarea.field");
		fields.each(function(index, value){
			var $this = $(this);
			var uid = $this.attr("data-uid");
			var content = $this.val();
			var success = function(){
				if(index == fields.length - 1) {
					location.reload();
				}
			}
			if($this.attr("data-delete") == "true") {
				$.ajax("/admin/delete",{
					type: "POST",
					data: {
						uid: uid,
						page: page
					},
					success: success
				});
			} else {
				$.ajax("/admin/update",{
					type: "POST",
					data: {
						uid: uid,
						page: page,
						content: content
					},
					success: success
				});
			}
			
		});
	},
	removeField: function(button){
		var content = $(button).parent().parent().find("textarea.field");
		content.attr("data-delete", "true");
		content.css("visibility", "hidden");
		$(button).parent().css("text-decoration", "line-through")
	}
}