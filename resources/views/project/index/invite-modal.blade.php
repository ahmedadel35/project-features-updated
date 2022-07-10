<div class="" x-data="{
    projectModal: false,
    open: function(slug) {
        this.projectModal = true
        console.log(slug)
    },
}">
<x-modal id='projectModal' :title="__('project.invite_title')" event="project-invite-modal" action="open($event.detail)">
    
</x-modal>
</div>