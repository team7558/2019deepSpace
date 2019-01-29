/*----------------------------------------------------------------------------*/
/* Copyright (c) 2017-2018 FIRST. All Rights Reserved.                        */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot;

import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;

import edu.wpi.first.wpilibj.TimedRobot;
import edu.wpi.first.wpilibj.command.Command;
import edu.wpi.first.wpilibj.command.Scheduler;
import edu.wpi.first.wpilibj.smartdashboard.SendableChooser;
import edu.wpi.first.wpilibj.smartdashboard.SmartDashboard;
import frc.robot.commands.ExampleCommand;
import frc.robot.subsystems.ExampleSubsystem;
import edu.wpi.first.wpilibj.drive.DifferentialDrive;
import edu.wpi.first.wpilibj.Compressor;
import edu.wpi.first.wpilibj.Joystick;
import edu.wpi.first.wpilibj.SpeedControllerGroup;
import com.revrobotics.CANEncoder;
import frc.robot.subsystems.*;

/**
 * The VM is configured to automatically run this class, and to call the
 * functions corresponding to each mode, as described in the TimedRobot
 * documentation. If you change the name of this class or the package after
 * creating this project, you must also update the build.gradle file in the
 * project.
 */
public class Robot extends TimedRobot {
  public static ExampleSubsystem m_subsystem = new ExampleSubsystem();
  public static OI m_oi;
  Command m_autonomousCommand;
  SendableChooser<Command> m_chooser = new SendableChooser<>();
<<<<<<< HEAD

=======
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c
  private static SpeedControllerGroup m_leftMotorGroup, m_rightMotorGroup;
  public static Joystick m_controller_1;
  private static final int CONTROLLER_1 = 0;
  private static CANSparkMax[] m_motors = new CANSparkMax[11];
  private static CANEncoder[] m_encoders = new CANEncoder[m_motors.length];
  private DifferentialDrive m_myRobot;
  public static Cargo m_Cargo = new Cargo();
<<<<<<< HEAD
  public static double speed;
=======
  private static Compressor m_testCompressor;
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c

  /**
   * This function is run when the robot is first started up and should be used
   * for any initialization code.
   */

  @Override
  public void robotInit() {
    m_oi = new OI();
    m_chooser.setDefaultOption("Default Auto", new ExampleCommand());
    // chooser.addOption("My Auto", new MyAutoCommand());
    SmartDashboard.putData("Auto mode", m_chooser);

    m_motors[1] = new CANSparkMax(RobotMap.LEFT_MOTOR_1, MotorType.kBrushless);
    m_motors[2] = new CANSparkMax(RobotMap.LEFT_MOTOR_2, MotorType.kBrushless);
    m_motors[3] = new CANSparkMax(RobotMap.RIGHT_MOTOR_1, MotorType.kBrushless);
    m_motors[4] = new CANSparkMax(RobotMap.RIGHT_MOTOR_2, MotorType.kBrushless);
    m_encoders[1] = new CANEncoder(m_motors[1]);
    m_encoders[2] = new CANEncoder(m_motors[2]);
<<<<<<< HEAD

    m_leftMotorGroup = new SpeedControllerGroup(m_motors[1], m_motors[2]);
    m_rightMotorGroup = new SpeedControllerGroup(new CANSparkMax(RobotMap.RIGHT_MOTOR_1, MotorType.kBrushless),
        new CANSparkMax(RobotMap.RIGHT_MOTOR_2, MotorType.kBrushless));

    m_myRobot = new DifferentialDrive(m_leftMotorGroup, m_rightMotorGroup);
    m_controller_1 = new Joystick(CONTROLLER_1);

    m_intake_1 = new VictorSPX(4);
    m_intake_2 = new VictorSPX(5);

    m_testSolenoid = new Solenoid(3);

    m_testCompressor = new Compressor();

    // m_myRobot = new DifferentialDrive(m_leftMotorGroup, m_rightMotorGroup);
    m_driveStick = new Joystick(0);

=======
    m_testCompressor = new Compressor();
    m_leftMotorGroup = new SpeedControllerGroup(m_motors[1], m_motors[2]);
    m_rightMotorGroup = new SpeedControllerGroup(m_motors[3], m_motors[4]);
    m_myRobot = new DifferentialDrive(m_leftMotorGroup, m_rightMotorGroup);
    m_controller_1 = new Joystick(CONTROLLER_1);
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c
  }

  /**
   * This function is called every robot packet, no matter the mode. Use this for
   * items like diagnostics that you want ran during disabled, autonomous,
   * teleoperated and test.
   *
   * <p>
   * This runs after the mode specific periodic functions, but before LiveWindow
   * and SmartDashboard integrated updating.
   */
  @Override
  public void robotPeriodic() {
  }

  /**
   * This function is called once each time the robot enters Disabled mode. You
   * can use it to reset any subsystem information you want to clear when the
   * robot is disabled.
   */
  @Override
  public void disabledInit() {
  }

  @Override
  public void disabledPeriodic() {
    Scheduler.getInstance().run();
  }

  /**
   * This autonomous (along with the chooser code above) shows how to select
   * between different autonomous modes using the dashboard. The sendable chooser
   * code works with the Java SmartDashboard. If you prefer the LabVIEW Dashboard,
   * remove all of the chooser code and uncomment the getString code to get the
   * auto name from the text box below the Gyro
   *
   * <p>
   * You can add additional auto modes by adding additional commands to the
   * chooser code above (like the commented example) or additional comparisons to
   * the switch structure below with additional strings & commands.
   */
  @Override
  public void autonomousInit() {
    m_autonomousCommand = m_chooser.getSelected();

    /*
     * String autoSelected = SmartDashboard.getString("Auto Selector", "Default");
     * switch(autoSelected) { case "My Auto": autonomousCommand = new
     * MyAutoCommand(); break; case "Default Auto": default: autonomousCommand = new
     * ExampleCommand(); break; }
     */

    // schedule the autonomous command (example)
    if (m_autonomousCommand != null) {
      m_autonomousCommand.start();
    }
  }

  /**
   * This function is called periodically during autonomous.
   */
  @Override
  public void autonomousPeriodic() {
    if (m_controller_1.getRawButton(1))
      System.out.println("ok");
    Scheduler.getInstance().run();
  }

  @Override
  public void teleopInit() {
    // This makes sure that the autonomous stops running when
    // teleop starts running. If you want the autonomous to
    // continue until interrupted by another command, remove
    // this line or comment it out.
    if (m_autonomousCommand != null) {
      m_autonomousCommand.cancel();
    }
  }

  /**
   * This function is called periodically during operator control.
   */
  @Override
  public void teleopPeriodic() {
    double power = 0.2;
    double turnPower = 0.2;
<<<<<<< HEAD

=======
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c
    if (m_controller_1.getRawButton(3)) { // b button
      m_testCompressor.start();
      m_testCompressor.setClosedLoopControl(true);
    } else {
      m_testCompressor.stop();
    }

<<<<<<< HEAD
    speed = m_controller_1.getY();
    m_intake_1.set(ControlMode.PercentOutput, speed);
    m_intake_2.set(ControlMode.PercentOutput, -speed);
    m_myRobot.arcadeDrive(m_driveStick.getY() * power, m_driveStick.getZ() * turnPower);
=======
    // double speed = m_controller_1.getY();
    // m_intake_1.set(ControlMode.PercentOutput, speed);
    // m_intake_2.set(ControlMode.PercentOutput, -speed);
    m_myRobot.arcadeDrive(m_controller_1.getY() * power, m_controller_1.getZ() * turnPower);
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c

    // turn compressor on until the pressure swtich triggers
    /*
     * double speed = m_controller_1.getY(); speed *= 0.6; //c.start();
     * //System.out.println("hello");
     * 
<<<<<<< HEAD
     * 
     * 
=======
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c
     * // m_testMotor.set(speed); // toggle switch instead now if
     * (m_controller_1.getRawButton(3)) { //System.out.println("gotten"); //
     * testSolenoid.set(DoubleSolenoid.Value.kOff); //m_testSolenoid.set(false); //
     * testSolenoid.set(DoubleSolenoid.Value.kReverse); m_testCompressor.start();
     * System.out.println("tedt"); } else { // m_testSolenoid.set(true); }
     * 
     * m_robotDrive.tankDrive(speed, speed);
     */
    Scheduler.getInstance().run();
  }

  /**
   * This function is called periodically during test mode.
   */
  @Override
  public void testPeriodic() {
    /*
     * double speed = m_controller_1.getY();
     * m_intake_1.set(ControlMode.PercentOutput, speed);
     * m_intake_2.set(ControlMode.PercentOutput, -speed);
     */
<<<<<<< HEAD
    if (m_controller_1.getRawButton(3)) { // b button
      m_testCompressor.start();
      m_testCompressor.setClosedLoopControl(true);
    } else {
      // m_testCompressor.stop();
    }
    if (m_controller_1.getRawButton(2)) { // a button push it out
      m_testSolenoid.set(false);
    } else {
      m_testSolenoid.set(true);
    }
    if (m_controller_1.getRawButton(1)) { // x button retrackt should be useless
      // System.out.println("hello");
      m_testSolenoid.set(true);
    }

=======
    // if (m_controller_1.getRawButton(3)){ // b button
    // m_testCompressor.start();
    // m_testCompressor.setClosedLoopControl(true);
    // }else{
    // m_testCompressor.stop();
    // }
    // if (m_controller_1.getRawButton(2)){ // a button push it out
    // m_testSolenoid.set(false);
    // }else{
    // m_testSolenoid.set(true);
    // }
    // if(m_controller_1.getRawButton(1)){ //x button retrackt should be useless
    // System.out.println("hello");
    // m_testSolenoid.set(true);
    // }
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c
    // m_testCompressor.stop();
  }
}