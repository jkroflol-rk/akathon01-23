var cy = cytoscape({
    container: document.getElementById("cy"), // container to render in

    wheelSensitivity: 0.1,

    style: [
        // the stylesheet for the graph
        {
            selector: "node",
            style: {
                "background-color": "#666",
                label: "data(label)",
                shape: "rectangle",
                "font-size": 10,
                "text-background-opacity": 1,
                "text-background-shape": "rectangle",
                "text-background-color": "black",
                "color": "white",
                "text-valign": "bottom"
            },
        },
        {
            selector: "edge",
            style: {
                width: 2,
                "line-color": "#444",
                "curve-style": "bezier",
                "control-point-step-size": 80, // change this value to adjust the curve
                "line-style": "dashed",
                "line-dash-pattern": [6, 4],
                "font-size": 10,
                "text-wrap": "wrap",
                "text-max-width": "100px",
                // sourceLabel: "G1/0/X",
                // targetLabel: "G1/0/Y",
                "source-text-offset": "30px",
                "target-text-offset": "10px",
                "source-text-margin-y": "-10px",
                "target-text-margin-y": "-10px",
                "text-opacity": 0,
                "text-background-opacity": 1,
                "text-background-color": "black",
                "color": "yellow",
            },
        },
    ],
});

cy.add([{ data: { id: "router", label: "Router" } }]);

cy.add([
    { data: { id: "core1", label: "Core 1", layer: "core" } },
    // { data: { id: "core2", label: "Core 2", layer: "core" } },
]);

cy.add([
    { data: { id: "dist1", label: "Dist 1", layer: "distribution" } },
    { data: { id: "dist2", label: "Dist 2", layer: "distribution" } },
    { data: { id: "dist3", label: "Dist 3", layer: "distribution" } },
    // { data: { id: "dist4", label: "Dist 4", layer: "distribution" } },
]);

cy.add([
    { data: { id: "access1", label: "Access 1", layer: "access" } },
    { data: { id: "access2", label: "Access 2", layer: "access" } },
    { data: { id: "access3", label: "Access 3", layer: "access" } },
    { data: { id: "access4", label: "Access 4", layer: "access" } },
    { data: { id: "access5", label: "Access 5", layer: "access" } },
    { data: { id: "access6", label: "Access 6", layer: "access" } },
]);

cy.nodes('[layer="core"]').style({
    "background-image": "./images/3650.png",
    "background-fit": "contain",
    "background-opacity": "0",
});

cy.nodes('[layer="distribution"]').style({
    "background-image": "./images/3650.png",
    "background-fit": "contain",
    "background-opacity": "0",
});

cy.nodes('[layer="access"]').style({
    "background-image": "./images/sw.png",
    "background-fit": "contain",
    "background-opacity": "0",
});

cy.nodes('[id="router"]').style({
    "background-image": "./images/router.png",
    "background-fit": "contain",
    "background-opacity": "0",
});

cy.nodes('[layer="core"]').forEach(function (core) {
    cy.add({
        data: {
            id: core.id() + "-" + "router", // unique id for the edge
            source: "router", // set the source to the id of the "Router" node
            target: core.id(), // set the target to the id of the current core node
        },
        style: {
            "line-style": "solid",
        }
    });
});

// Create edges between distribution and core switches
cy.nodes('[layer="distribution"]').forEach(function (distribution) {
    cy.nodes('[layer="core"]').forEach(function (core) {
        cy.add({
            data: {
                id: distribution.id() + "-" + core.id(),
                source: core.id(),
                target: distribution.id(),
            },
            style: {
                sourceLabel: "yes",
                targetLabel: "no",
            }
        });
    });
});

// Create edges between access and distribution switches
cy.nodes('[layer="access"]').forEach(function (access) {
    cy.nodes('[layer="distribution"]').forEach(function (distribution) {
        cy.add({
            data: {
                id: access.id() + "-" + distribution.id(),
                source: distribution.id(),
                target: access.id(),
            },
        });
    });
});

cy.on("select unselect", "edge", function (evt) {
    evt.target.style("text-opacity", evt.target.selected() ? 1 : 0);
    evt.target.style("line-color", evt.target.selected() ? "#1ca3ec" : "#444");
    evt.target.style("z-index", evt.target.selected() ? "3" : "1");
});

cy.on("tap", function (event) {
    if (event.target === cy) {
        cy.elements().style("line-color", "#444"); // reset line color of all edges
    }
});

cy.nodes().on("tap", function (event) {
    var clickedNode = event.target;
    var connectedEdges = cy.elements().edgesWith(clickedNode);

    cy.elements().style("line-color", "#444"); // reset line color of all edges
    setTimeout(function () {
        connectedEdges.style("line-color", "red"); // highlight the edges connected to the clicked node
    }, 50);
});

var layout = cy.layout({
    name: "dagre",
    rankDir: "TB", // top to bottom
    rankSep: 120,
    nodeSep: 120,
});

layout.run();


// fetch('output.json')
//     .then(response => response.json())
//     .then(data => {
//         var cy = cytoscape({
//             container: document.getElementById("cy"), // container to render in

//             elements: data,

//         });

//         var layout = cy.layout({
//             name: "dagre",
//             rankDir: "TB", // top to bottom
//             rankSep: 120,
//             nodeSep: 120,
//         });
        
//         layout.run();
//     });













