<?php

include("inc/header.php");
Session::CheckSession();

//error_reporting(0);




include("connection.php");
$admin = "SELECT * FROM employees WHERE employee_ID='PB0009'";
$admin_result = mysqli_query($conn, $admin) or die('request "Could not execute SQL query" '.$admin);
$senior = mysqli_fetch_assoc($admin_result);
$sql = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_result = mysqli_query ($conn, $sql ) or die ('request "Could not execute SQL query" '.$sql);

$sqlmt = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null and employees.TitleOfCourtesy='Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultmt = mysqli_query ($conn, $sqlmt ) or die ('request "Could not execute SQL query" '.$sqlmt);
$sqlft = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null and employees.TitleOfCourtesy<>'Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultft = mysqli_query ($conn, $sqlft ) or die ('request "Could not execute SQL query" '.$sqlft);

$snr = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank='1' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultsnr = mysqli_query ($conn, $snr ) or die ('request "Could not execute SQL query" '.$snr);

$snrm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank='1' and employees.TitleOfCourtesy='Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultsnrm = mysqli_query ($conn, $snrm ) or die ('request "Could not execute SQL query" '.$snrm);
$snrf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank='1' and employees.TitleOfCourtesy<>'Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultsnrf = mysqli_query ($conn, $snrf ) or die ('request "Could not execute SQL query" '.$snrf);

$jnr = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=2 GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultjnr = mysqli_query ($conn, $jnr ) or die ('request "Could not execute SQL query" '.$jnr);

$jnrm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=2 and employees.TitleOfCourtesy='Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultjnrm = mysqli_query ($conn, $jnrm ) or die ('request "Could not execute SQL query" '.$jnrm);
$jnrf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=2 and employees.TitleOfCourtesy<>'Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultjnrf = mysqli_query ($conn, $jnrf ) or die ('request "Could not execute SQL query" '.$jnrf);

$ctr = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=3 GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultctr = mysqli_query ($conn, $ctr) or die ('request "Could not execute SQL query" '.$ctr);

$ctrm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=3 and employees.TitleOfCourtesy='Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultctrm = mysqli_query ($conn, $ctrm ) or die ('request "Could not execute SQL query" '.$ctrm);
$ctrf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=3 and employees.TitleOfCourtesy<>'Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultctrf = mysqli_query ($conn, $ctrf ) or die ('request "Could not execute SQL query" '.$ctrf);

$cas = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=4 GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultcas = mysqli_query ($conn, $cas ) or die ('request "Could not execute SQL query" '.$cas);

$casm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=4 and employees.TitleOfCourtesy='Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultcasm = mysqli_query ($conn, $casm) or die ('request "Could not execute SQL query" '.$casm);
$casf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=4 and employees.TitleOfCourtesy<>'Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultcasf = mysqli_query ($conn, $casf ) or die ('request "Could not execute SQL query" '.$casf);

$term = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='1'";
$sql_resulterm = mysqli_query ($conn, $term ) or die ('request "Could not execute SQL query" '.$term);
$termm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='1' and employees.TitleOfCourtesy='Mr.'";
$sql_resultermm = mysqli_query ($conn, $termm ) or die ('request "Could not execute SQL query" '.$termm);
$termf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='1' and employees.TitleOfCourtesy<>'Mr.'";
$sql_resultermf = mysqli_query ($conn, $termf ) or die ('request "Could not execute SQL query" '.$termf);

$res = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='2'";
$sql_resulres = mysqli_query ($conn, $res ) or die ('request "Could not execute SQL query" '.$res);
$resm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='2' and employees.TitleOfCourtesy='Mr.'";
$sql_resulresm = mysqli_query ($conn, $resm ) or die ('request "Could not execute SQL query" '.$resm);
$resf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='2' and employees.TitleOfCourtesy<>'Mr.'";
$sql_resulresf = mysqli_query ($conn, $resf) or die ('request "Could not execute SQL query" '.$resf);

$ret = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='3'";
$sql_resulret = mysqli_query ($conn, $ret ) or die ('request "Could not execute SQL query" '.$ret);
$retm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='3' and employees.TitleOfCourtesy='Mr.'";
$sql_resulretm = mysqli_query ($conn, $retm) or die ('request "Could not execute SQL query" '.$retm);
$retf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='3' and employees.TitleOfCourtesy<>'Mr.'";
$sql_resulretf = mysqli_query ($conn, $retf ) or die ('request "Could not execute SQL query" '.$retf);

$vac = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='4'";
$sql_resulvac = mysqli_query ($conn, $vac ) or die ('request "Could not execute SQL query" '.$vac);
$vacm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='4' and employees.TitleOfCourtesy='Mr.'";
$sql_resulvacm = mysqli_query ($conn, $vacm ) or die ('request "Could not execute SQL query" '.$vacm);
$vacf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='4' and employees.TitleOfCourtesy<>'Mr.'";
$sql_resulvacf = mysqli_query ($conn, $vacf ) or die ('request "Could not execute SQL query" '.$vacf);


$des = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='5'";
$sql_resuldes = mysqli_query ($conn, $des ) or die ('request "Could not execute SQL query" '.$des);
$desm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='5' and employees.TitleOfCourtesy='Mr.'";
$sql_resuldesm = mysqli_query ($conn, $desm ) or die ('request "Could not execute SQL query" '.$desm);
$desf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='5' and employees.TitleOfCourtesy<>'Mr.'";
$sql_resuldesf = mysqli_query ($conn, $desf ) or die ('request "Could not execute SQL query" '.$desf);

$tcas = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='6'";
$sql_resulttcas = mysqli_query ($conn, $tcas ) or die ('request "Could not execute SQL query" '.$tcas);

$tcasm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='6' and employees.TitleOfCourtesy='Mr.'";
$sql_resulttcasm = mysqli_query ($conn, $tcasm ) or die ('request "Could not execute SQL query" '.$tcasm);
$tcasf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name, appointment_status.termination_reason FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id INNER JOIN appointment_status ON employees.apt_status=appointment_status.id WHERE employees.apt_status='6' and employees.TitleOfCourtesy<>'Mr.'";
$sql_resulttcasf = mysqli_query ($conn, $tcasf ) or die ('request "Could not execute SQL query" '.$tcasf);

$expctr = "SELECT a.* FROM contracts a JOIN (SELECT `employee_ID`, MAX(`due_date`) due_date FROM contracts GROUP BY `employee_ID`) b ON a.`employee_ID`=b.`employee_ID` and a.`due_date`=b.`due_date` INNER JOIN employees e ON a.`employee_ID`=e.`employee_ID` WHERE a.`due_date` <= now() AND e.apt_status is null AND e.rank=3";
$sql_resultexpctr = mysqli_query ($conn, $expctr ) or die ('request "Could not execute SQL query" '.$expctr);
$expctrm = "SELECT a.* FROM contracts a JOIN (SELECT `employee_ID`, MAX(`due_date`) due_date FROM contracts GROUP BY `employee_ID`) b ON a.`employee_ID`=b.`employee_ID` and a.`due_date`=b.`due_date` INNER JOIN employees e ON a.`employee_ID`=e.`employee_ID` WHERE a.`due_date` <= now() AND e.apt_status is null AND e.TitleOfCourtesy='Mr.' AND e.rank=3";
$sql_resultexpctrm = mysqli_query ($conn, $expctrm ) or die ('request "Could not execute SQL query" '.$expctrm);
$expctrf = "SELECT a.* FROM contracts a JOIN (SELECT `employee_ID`, MAX(`due_date`) due_date FROM contracts GROUP BY `employee_ID`) b ON a.`employee_ID`=b.`employee_ID` and a.`due_date`=b.`due_date` INNER JOIN employees e ON a.`employee_ID`=e.`employee_ID` WHERE a.`due_date` <= now() AND e.apt_status is null AND e.TitleOfCourtesy<>'Mr.' AND e.rank=3";
$sql_resultexpctrf = mysqli_query ($conn, $expctrf) or die ('request "Could not execute SQL query" '.$expctrf);

//$leave = "SELECT a.`employee_ID`, e.TitleOfCourtesy, e.FirstName, e.Middle_name, e.LastName,a.`starting_date`, a.`leave_type`, a.`designated_leave_days`, a.`num_used`, a.`num_left`, add_workday(a.`starting_date`,(a.`num_used` - 1)) as end_date FROM  employee_leave a  JOIN (SELECT `employee_ID`, MAX(`starting_date`) starting_date FROM employee_leave GROUP BY `employee_ID`) b ON a.`employee_ID`=b.`employee_ID` and a.`starting_date`=b.`starting_date` INNER JOIN employees e ON a.`employee_ID`=e.`employee_ID` WHERE add_workday(a.`starting_date`,(a.`num_used` - 1))>now()";
//$sql_resultleave = mysqli_query ($conn, $leave) or die ('request "Could not execute SQL query" '.$leave);
//$leavem = "SELECT a.`employee_ID`, e.TitleOfCourtesy, e.FirstName, e.Middle_name, e.LastName,a.`starting_date`, a.`leave_type`, a.`designated_leave_days`, a.`num_used`, a.`num_left`, add_workday(a.`starting_date`,(a.`num_used` - 1)) as end_date FROM  employee_leave a  JOIN (SELECT `employee_ID`, MAX(`starting_date`) starting_date FROM employee_leave GROUP BY `employee_ID`) b ON a.`employee_ID`=b.`employee_ID` and a.`starting_date`=b.`starting_date` INNER JOIN employees e ON a.`employee_ID`=e.`employee_ID` WHERE add_workday(a.`starting_date`,(a.`num_used` - 1))>now() AND e.TitleOfCourtesy='Mr.'";
//$sql_resultleavem = mysqli_query ($conn, $leavem) or die ('request "Could not execute SQL query" '.$leavem);
//$leavef = "SELECT a.`employee_ID`, e.TitleOfCourtesy, e.FirstName, e.Middle_name, e.LastName,a.`starting_date`, a.`leave_type`, a.`designated_leave_days`, a.`num_used`, a.`num_left`, add_workday(a.`starting_date`,(a.`num_used` - 1)) as end_date FROM  employee_leave a  JOIN (SELECT `employee_ID`, MAX(`starting_date`) starting_date FROM employee_leave GROUP BY `employee_ID`) b ON a.`employee_ID`=b.`employee_ID` and a.`starting_date`=b.`starting_date` INNER JOIN employees e ON a.`employee_ID`=e.`employee_ID` WHERE add_workday(a.`starting_date`,(a.`num_used` - 1))>now() AND e.TitleOfCourtesy<>'Mr.'";
//$sql_resultleavef = mysqli_query ($conn, $leavef) or die ('request "Could not execute SQL query" '.$leavef);

$seniors = mysqli_num_rows($sql_resultsnr);
$junior = mysqli_num_rows($sql_resultjnr);
$contract = mysqli_num_rows($sql_resultctr);
$casual = mysqli_num_rows($sql_resultcas);

$seniorsm = mysqli_num_rows($sql_resultsnrm);
$juniorm = mysqli_num_rows($sql_resultjnrm);
$contractm = mysqli_num_rows($sql_resultctrm);
$casualm = mysqli_num_rows($sql_resultcasm);
$terminatem = mysqli_num_rows($sql_resultermm);
$resignm = mysqli_num_rows($sql_resulresm);
$retirem = mysqli_num_rows($sql_resulretm);
$vacatem = mysqli_num_rows($sql_resulvacm);
$deseasedm = mysqli_num_rows($sql_resuldesm);
$tcasualm = mysqli_num_rows($sql_resulttcasm);

$seniorsf = mysqli_num_rows($sql_resultsnrf);
$juniorf = mysqli_num_rows($sql_resultjnrf);
$contractf = mysqli_num_rows($sql_resultctrf);
$casualf = mysqli_num_rows($sql_resultcasf);
$terminatef = mysqli_num_rows($sql_resultermf);
$resignf = mysqli_num_rows($sql_resulresf);
$retiref = mysqli_num_rows($sql_resulretf);
$vacatef = mysqli_num_rows($sql_resulvacf);
$deseasedf = mysqli_num_rows($sql_resuldesf);
$tcasualf = mysqli_num_rows($sql_resulttcasf);

$total_records = mysqli_num_rows($sql_result);
$total_recordsm = mysqli_num_rows($sql_resultmt);
$total_recordsf = mysqli_num_rows($sql_resultft);
$terminate = mysqli_num_rows($sql_resulterm);
$resign = mysqli_num_rows($sql_resulres);
$retire = mysqli_num_rows($sql_resulret);
$vacate = mysqli_num_rows($sql_resulvac);
$deseased = mysqli_num_rows($sql_resuldes);
$tcasual = mysqli_num_rows($sql_resulttcas);

$expired = mysqli_num_rows($sql_resultexpctr);
$expiredm = mysqli_num_rows($sql_resultexpctrm);
$expiredf = mysqli_num_rows($sql_resultexpctrf);

/*$leaven = mysqli_num_rows($sql_resultleave);
$leavenm = mysqli_num_rows($sql_resultleavem);
$leavenf = mysqli_num_rows($sql_resultleavef);*/

$dashboard = "active";
?>
        
      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <?php include("menu.php"); ?>
	  
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $total_records; ?></h3>
                  <p>Working Staff</p>
                  Male - <?php echo $total_recordsm;?><br>
				  Female - <?php echo $total_recordsf;?>
				  <div style="position: absolute; top: 8px; right: 10px; z-index: 0; border-left: 1px solid #fff; padding-left: 8px;">
				  <h3><?php echo $total_records-$casual; ?></h3>
				<p>Permanent Staff</p>
                  Male - <?php echo $total_recordsm-$casualm;?><br>
				  Female - <?php echo $total_recordsf-$casualf;?>
				  </div>
                </div>
				
                <div class="icon">
                  <i class="ion ion-ios-people"></i>
				  
                </div>
                <a href="pages/profile/profileview.php" class="small-box-footer">View Employees <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo round(($seniors/$total_records)*100, 2); ?><sup style="font-size: 20px">%</sup></h3>
                  <p><?php echo $seniors; ?> Senior Staff</p>
                  Male - <?php echo $seniorsm;?><br>
				  Female - <?php echo $seniorsf;?>
                </div>
                <div class="icon">
                  <i class="ion ion-android-people"></i>
                </div>
                <a href="pages/profile/profileview.php?rank=1" class="small-box-footer">View Senior Staff <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo round(($junior/$total_records)*100, 2); ?><sup style="font-size: 20px">%</sup></h3>
                  <p><?php echo $junior; ?> Junior Staff</p>
                  Male - <?php echo $juniorm;?><br>
				  Female - <?php echo $juniorf;?>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-people-outline"></i>
                </div>
                <a href="pages/profile/profileview.php?rank=2" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo round(($contract/$total_records)*100, 2);?><sup style="font-size: 20px">%</sup></h3>
                  <p><?php echo $contract;?> on Contract</p>
                  Male - <?php echo $contractm;?><br>
				  Female - <?php echo $contractf;?>
                </div>
                <div class="icon">
                  <i class="ion ion-android-contacts"></i>
                </div>
                <a href="pages/profile/profileview.php?rank=3" class="small-box-footer">View Employees on Contract <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
            <!-- small box -->
              <div class="small-box bg-teal">
                <div class="inner">
                  <h3><?php echo round(($casual/$total_records)*100, 2); ?><sup style="font-size: 20px">%</sup></h3>
                  <p><?php echo $casual;?> Casuals</p>
                  Male - <?php echo $casualm;?><br>
				  Female - <?php echo $casualf;?>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-people-outline"></i>
                </div>
                <a href="pages/table/casual.php" class="small-box-footer">View Casuals <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
			<div class="col-lg-4 col-xs-6">
            <!-- employees on leave -->
              <div class="small-box bg-lime">
                <div class="inner">
                  <h3><?php //echo $leaven;?></h3>
                  <p>Employees On Leave</p>
                  Male - <?php //echo $leavenm;?><br>
				  Female - <?php //echo $leavenf;?>                </div>
                <div class="icon">
                  <i class="ion ion-ios-people-outline"></i>
                </div>
                <a href="pages/table/leave.php" class="small-box-footer">View Casuals <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-4 col-xs-4" style="cursor:pointer" onclick="location.href='pages/table/expired.php';">
            <!-- small box -->
              <div class="info-box bg-red-active">
                <span class="info-box-icon" style="height: 137px;line-height: 137px;"><i class="ion-alert-circled"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Expired Contracts</span>
                  <span class="info-box-number"><?php echo $expired; ?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo ($expired/$contract)*100;?>%"></div>
                  </div>
                  <span class="progress-description">
                    <?php echo round(($expired/$contract)*100, 2);?>% of Contracts are expired
                  <p>Male - <?php echo $expiredm; ?><br>
					  Female - <?php echo $expiredf; ?></p>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->

            </div><!-- ./col -->
            <div class="col-lg-5 col-xs-4" style="cursor:pointer" onclick="location.href='pages/table/term_casual.php';">
            <!-- small box -->
              <div class="info-box bg-red-active">
                <span class="info-box-icon" style="height: 137px;line-height: 137px;"><i class="ion-backspace"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Terminated Casuals</span>
                  <span class="info-box-number"><?php echo $tcasual;?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo ($tcasual/$casual)*100;?>%"></div>
                  </div>
                  <span class="progress-description">
                    <?php echo round(($tcasual/$casual)*100, 2);?>% of Casuals removed from the system
                    <p>Male - <?php echo $tcasualm;?><br>
						Female - <?php echo $tcasualf;?></p>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->

            </div><!-- ./col -->
          </div><!-- /.row -->
           <!-- Info boxes -->
          <div class="row">
            
            <div class="col-md-3 col-sm-6 col-xs-12" style="cursor:pointer" onclick="location.href='pages/table/terminated.php';">
              <div class="info-box" >
                <span class="info-box-icon bg-red"><i class="ion ion-android-cancel"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Terminated</span>
                  <span class="info-box-number"><?php echo $terminate; ?></span>
                  Male - <?php echo $terminatem;?><br>
				  Female - <?php echo $terminatef;?>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12" style="cursor:pointer" onclick="location.href='pages/table/retired.php';">
              <div class="info-box">
                <span class="info-box-icon bg-fuchsia"><i class="ion ion-backspace-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Retired</span>
                  <span class="info-box-number"><?php echo $retire; ?></span>
                  Male - <?php echo $retirem;?><br>
				  Female - <?php echo $retiref;?>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12" style="cursor:pointer" onclick="location.href='pages/table/resigned.php';">
              <div class="info-box">
                <span class="info-box-icon bg-maroon"><i class="ion ion-android-close"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Resigned</span>
                  <span class="info-box-number"><?php echo $resign; ?></span>
                  Male - <?php echo $resignm;?><br>
				  Female - <?php echo $resignf;?>
                </div>
                <!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
   <div class="col-md-3 col-sm-6 col-xs-12" style="cursor:pointer" onclick="location.href='pages/table/vacated.php';">
              <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="ion ion-ios-close-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">VACATED</span>
                  <span class="info-box-number"><?php echo $vacate; ?></span>
                  Male - <?php echo $vacatem;?><br>
				  Female - <?php echo $vacatef;?>
                </div>
                <!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
	
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12" style="cursor:pointer" onclick="location.href='pages/table/deceased.php';">
              		<div class="info-box">
                	<span class="info-box-icon bg-red"><i class="ion ion-ios-close-outline"></i></span>
               		 <div class="info-box-content">
                  	<span class="info-box-text">DECEASED</span>
                  	<span class="info-box-number"><?php echo $deseased; ?></span>
                  	Male - <?php echo $deseasedm;?><br>
				  Female - <?php echo $deseasedf;?>
                </div>
                <!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
</div><!--/.row-->
          
          
    <!--      <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Monthly Recap Report</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!- /.box-header 
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                      <p class="text-center">
                        <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                      </p>
                      <div class="chart">
                        <!- Sales Chart Canvas 
                        <canvas id="salesChart" style="height: 180px;"></canvas>
                      </div><!- /.chart-responsive --
                    </div><!- /.col --
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Goal Completion</strong>
                      </p>
                      <div class="progress-group">
                        <span class="progress-text">Add Products to Cart</span>
                        <span class="progress-number"><b>160</b>/200</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                        </div>
                      </div><!- /.progress-group --
                      <div class="progress-group">
                        <span class="progress-text">Complete Purchase</span>
                        <span class="progress-number"><b>310</b>/400</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                        </div>
                      </div><!- /.progress-group --
                      <div class="progress-group">
                        <span class="progress-text">Visit Premium Page</span>
                        <span class="progress-number"><b>480</b>/800</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                        </div>
                      </div><!- /.progress-group --
                      <div class="progress-group">
                        <span class="progress-text">Send Inquiries</span>
                        <span class="progress-number"><b>250</b>/500</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                        </div>
                      </div><!- /.progress-group --
                    </div><!- /.col --
                  </div><!- /.row -->
                </div><!-- ./box-body --
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                        <h5 class="description-header">$35,210.43</h5>
                        <span class="description-text">TOTAL REVENUE</span>
                      </div><!- /.description-block --
                    </div><!- /.col --
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                        <h5 class="description-header">$10,390.90</h5>
                        <span class="description-text">TOTAL COST</span>
                      </div><!- /.description-block --
                    </div><!- /.col --
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                        <h5 class="description-header">$24,813.53</h5>
                        <span class="description-text">TOTAL PROFIT</span>
                      </div><!- /.description-block --
                    </div><!- /.col --
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block">
                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                        <h5 class="description-header">1200</h5>
                        <span class="description-text">GOAL COMPLETIONS</span>
                      </div><!- /.description-block --
                    </div>
                  </div><!- /.row --
                </div><!- /.box-footer --
              </div><!- /.box --
            </div><!- /.col --
          </div><!- /.row --
		  -->
		  
          <!-- Main row --
          <div class="row">
            <!- Left col --
            <section class="col-lg-7 connectedSortable">
              <!- Custom tabs (Charts with tabs)--
              <div class="nav-tabs-custom">
                <!-Tabs within a box --
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                  <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                  <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                </ul>
                <div class="tab-content no-padding">
                  <!- Morris chart - Sales --
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                </div>
              </div><!- /.nav-tabs-custom -->

              <!-- Chat box -->
              <!-- /.box (chat box) -->

              <!-- TO DO List -->
              <!-- /.box -->

            <!--</section><!- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

  </body>
</html>
