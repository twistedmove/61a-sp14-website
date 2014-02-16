"use strict";

function focus_callback() {
  //for clients to override
}

function cleanCode(code) {
  //cleans extra newlines that exist to make in-html code look better
  return code.replace(/^\n/, "").replace(/\n*$/, "").replace(/[ \t]*\n/g, "\n").replace(/\s*$/, "");
}

function $_(s) {
  // _ to $ where _ = div id's, $ = jQuery objects; read _ as #, $_ consumes a hash and adds a $
  var ret = $("[id={0}]".format(s).replace(/\?/, "\\\?"));
  if (!ret[0]) {
    throw "#" + s + " did not match anything";
  } else {
    return ret;
  }
}

////////////////////////////////////////////////////////////////////////////////

var depsOf = {}

function getDeps(_editor) {
  if (depsOf[_editor]) {
    return depsOf[_editor];
  } else {
    return [];
  }
}

function getDependedOnCode(_editor) {
  var code = "";

  for (var deps = getDeps(_editor), i = 0; i < deps.length; i++) {
    code += getDependedOnCode(deps[i]);
  }

  return code + editorOf[_editor].getValue();
}

////////////////////////////////////////////////////////////////////////////////

var editorOf = {};

function makeEditable(_editor) {

  if (editorOf[_editor]) {
    throw "Error: makeEditable called with " + _editor + " which already exists!";
  }

  var $editor = $_(_editor);
  var code = cleanCode($editor.text());

  $editor.empty();

  var editor = CodeMirror($editor[0], {
    'value': code,
    'matchBrackets': true
  });

  editor.setOption('extraKeys', {'Ctrl-Enter': function() {
    editor.getOption("onBlur")();
  }});

  editorOf[_editor] = editor;
  return editor;
}

function linkEditor(_editor, _output, func) { //sync

  var editor = editorOf[_editor];

  editor.setOption('onBlur', function() {
    $_(_output).empty().append($("<span>" + func(_editor, editor.getValue()) + "</span>"));
  });
}

////////////////////////////////////////////////////////////////////////////////

function getAllDeps(s) {
  var ret = [];
  for (var i = 0, d = getDeps(s); i < d.length; i++) {
    ret = ret.concat(getAllDeps(d[i]));
    ret.push(d[i]);
  }
  return ret;
}

function getAllPushes(s) {
  var ret = [];
  for (var i = 0, d = getPushes(s); i < d.length; i++) {
    ret.push(d[i]);
    ret = ret.concat(getAllPushes(d[i]));
  }
  return ret;
}

focus_callback = function(s) {
  var ts = "";
  for (var i = 0, d = getAllDeps(s); i < d.length; i++) {  //TODO list all deps
    ts += editorOf[d[i]].getValue() + "\n\n";
  }

  ts += "<b>" + editorOf[s].getValue() + "</b>";

  $("#currently-editing").html("<pre>" + ts + "</pre>");
};

////////////////////////////////////////////////////////////////////////////////

var pushesOf = {}

function getPushes(_editor) {
  if (pushesOf[_editor]) {
    return pushesOf[_editor];
  } else {
    return [];
  }
}

function addDep(_e, deps) {
  if (!isArray(deps)) {
    throw "deps is not an array: addDep " + _a
  }
  depsOf[_e] = deps;
  for (var i in deps) {
    var p = pushesOf[deps[i]];
    if (p) {
      p.push(_e);
    } else {
      pushesOf[deps[i]] = [_e];
    }
  }
}

function promptDep(_a, deps) {
  prompt(_a);
  addDep(_a, deps);
}

///////////////////////////////////////////////////////////////////////////////

function addOutput(_e) {
  $_(_e).after($('<div>', {'id': _e + "-output", 'class': "output"}));
}

function compute(s) {
  var def = $.Deferred();

  var _output = s + "-output";
  var output_fragment = [];

  var w = new Worker("js/interpreter/logic_worker.js");
  w.onmessage = function(e) {
    if (e.data.type === "end") {
      if (output_fragment.length == 0) {
        $_(_output).empty();
      }
      w.terminate();
      def.resolve();
      return;
    } else if (e.data.type === "return_value") {
      output_fragment.push($("<span class='output_displayed_text'>" + e.data.value.replace(/\n/, "<br>") + "</span>"));
    } else if (e.data.type === "displayed_text") {
      output_fragment.push($("<pre>" + e.data.value + "</pre>"));
    } else if (e.data.type === "error") {
      output_fragment.push($("<span class='output_error'>" + e.data.value + "<br> </span>"));
    } else {
      output_fragment.push($("<span>" + e.data + "<br> </span>"));
    }
    $_(_output).empty().append(output_fragment);
  }

  w.postMessage(getDependedOnCode(s));

  for (var pushes = getPushes(s), i = 0; i < pushes.length; i++) {
    compute(pushes[i]);
  }
  return def; //for template code to chain
}

function prompt(s, deps) {
  makeEditable(s).setOption('onBlur', function() {
    return compute(s);
  });
  addOutput(s);
  addDep(s, (deps || []));

}

function frozen_prompt(s, deps) {
  makeEditable(s);
  editorOf[s].setOption("readOnly", 'nocursor');
  editorOf[s].setOption('onBlur', function() {
    return compute(s);
  });
  addOutput(s);
  addDep(s, (deps || []));
}

function hidden_prompt(s, deps) {
  makeEditable(s);
  addOutput(s);

  $_(s).hide();
  $_(s + "-output").hide();

  addDep(s, (deps || []));
}

function no_output_prompt(s, deps) {
  makeEditable(s);

  addDep(s, (deps || []));
}

function no_output_frozen_prompt(s, deps) {
  makeEditable(s);
  $_(s).find(".CodeMirror-scroll").addClass("static")
  editorOf[s].setOption("readOnly", 'nocursor');

  addDep(s, (deps || []));
}

function makeStatic(_static) { //and no output
  no_output_frozen_prompt(_static);
}
