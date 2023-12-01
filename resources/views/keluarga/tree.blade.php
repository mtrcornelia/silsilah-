
<style>
    svg.tommy .node.female>rect {
      fill: #ff5b5b;
    }   
</style>

<script src="/js/BALKAN_FamilyTreeJS_FREE_1.09.07/FamilyTree.js"></script>
<div style="width:100%; height:700px;" id="tree"></div>

<script>
    let familyData = '<?php echo json_encode($familyTreeData);?>';
    let familyDataArray = JSON.parse(familyData);
    let sampleDataArray = [
            { id: 1, pids: [2], name: "Amber McKenzie", gender: "female" },
            { id: 2, pids: [1], name: "Ava Field", gender: "male" },
            { id: 3, pids: [4], fid: 7, name: "Ayah", gender: "male" },
            { id: 4, pids: [3], name: "Bunda", gender: "female" },
            { id: 5, mid: 4, fid: 3, name: "Budi", gender: "male" },
            { id: 6,fid: 3, name: "Sari", gender: "female" },
            { id: 7, mid: 2, fid: 1, name: "Peter", gender: "male" },
        ];

    let family = new FamilyTree(document.getElementById("tree"), {
        nodeBinding: {
            field_0: "name"
        },
        nodes: familyDataArray
    });
</script>


