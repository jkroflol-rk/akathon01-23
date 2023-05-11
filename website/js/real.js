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
      },
    },
    {
      selector: "edge",
      style: {
        width: 3,
        "line-color": "#aaa",
        "curve-style": "bezier",
        "control-point-step-size": 80, // change this value to adjust the curve
        "line-style": "dashed",
        "line-dash-pattern": [6, 3],
        "font-size": 10,
        "text-wrap": "wrap",
        "text-max-width": "100px",
        sourceLabel: "G1/0/X",
        targetLabel: "G1/0/Y",
        "source-text-offset": "30px",
        "target-text-offset": "10px",
        "source-text-margin-y": "-10px",
        "target-text-margin-y": "-10px",
        "text-opacity": 0,
      },
    },
  ],
});

cy.add([{ data: { id: "router", label: "Router" } }]);

cy.add([
  { data: { id: "core1", label: "Core 1", group: "core" } },
  { data: { id: "core2", label: "Core 2", group: "core" } },
]);

cy.add([
  { data: { id: "dist1", label: "Dist 1", group: "distribution" } },
  { data: { id: "dist2", label: "Dist 2", group: "distribution" } },
  { data: { id: "dist3", label: "Dist 3", group: "distribution" } },
  { data: { id: "dist4", label: "Dist 4", group: "distribution" } },
]);

cy.add([
  { data: { id: "access1", label: "Access 1", group: "access" } },
  { data: { id: "access2", label: "Access 2", group: "access" } },
  { data: { id: "access3", label: "Access 3", group: "access" } },
  { data: { id: "access4", label: "Access 4", group: "access" } },
  { data: { id: "access5", label: "Access 5", group: "access" } },
  { data: { id: "access6", label: "Access 6", group: "access" } },
]);

cy.nodes('[group="core"]').style({
  "background-image": "./images/3650.png",
  "background-fit": "contain",
  "background-opacity": "0",
});

cy.nodes('[group="distribution"]').style({
  "background-image": "./images/3650.png",
  "background-fit": "contain",
  "background-opacity": "0",
});

cy.nodes('[group="access"]').style({
  "background-image": "./images/sw.png",
  "background-fit": "contain",
  "background-opacity": "0",
});

cy.nodes('[id="router"]').style({
  "background-image": "./images/router.png",
  "background-fit": "contain",
  "background-opacity": "0",
});

cy.nodes('[group="core"]').forEach(function (core) {
  cy.add({
    data: {
      id: core.id() + "-" + "router", // unique id for the edge
      source: "router", // set the source to the id of the "Router" node
      target: core.id(), // set the target to the id of the current core node
    },
  });
});

// Create edges between distribution and core switches
cy.nodes('[group="distribution"]').forEach(function (distribution) {
  cy.nodes('[group="core"]').forEach(function (core) {
    cy.add({
      data: {
        id: distribution.id() + "-" + core.id(),
        source: core.id(),
        target: distribution.id(),
      },
    });
  });
});

// Create edges between access and distribution switches
cy.nodes('[group="access"]').forEach(function (access) {
  cy.nodes('[group="distribution"]').forEach(function (distribution) {
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
  evt.target.style("line-color", evt.target.selected() ? "#1ca3ec" : "#aaa");
});

cy.on("tap", function (event) {
  if (event.target === cy) {
    cy.elements().style("line-color", "#aaa"); // reset line color of all edges
  }
});

cy.nodes().on("tap", function (event) {
  var clickedNode = event.target;
  var connectedEdges = cy.elements().edgesWith(clickedNode);

  cy.elements().style("line-color", "#aaa"); // reset line color of all edges
  setTimeout(function() {
    connectedEdges.style("line-color", "red"); // highlight the edges connected to the clicked node
  }, 50);
});

var layout = cy.layout({
  name: "dagre",
  rankDir: "TB", // top to bottom
  rankSep: 100,
  nodeSep: 100,
});

layout.run();

cy.add([
  {
    data: { id: "node1" },
    style: { "background-color": "red", shape: "rectangle" },
  },
  {
    data: { id: "node2" },
    style: { "background-color": "blue", shape: "ellipse" },
  },
  {
    data: { id: "node3" },
    style: { "background-color": "green", shape: "triangle" },
  },
]);
