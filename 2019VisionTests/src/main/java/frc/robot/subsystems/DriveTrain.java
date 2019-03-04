/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.*/
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import com.ctre.phoenix.motorcontrol.can.WPI_VictorSPX;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;

import edu.wpi.first.wpilibj.Solenoid;
import edu.wpi.first.wpilibj.SpeedControllerGroup;
import edu.wpi.first.wpilibj.drive.DifferentialDrive;
import edu.wpi.first.wpilibj.command.Subsystem;
import frc.robot.RobotMap;
import frc.robot.Robot;

/**
 * Add your docs here.
 */
public class DriveTrain extends Subsystem { 
  //private CANSparkMax[] m_motors = new CANSparkMax[7];
  private WPI_VictorSPX[] m_motors = new WPI_VictorSPX[4];
  private CANEncoder[] m_motorEncoders = new CANEncoder[7];
  private SpeedControllerGroup m_leftMotorGroup, m_rightMotorGroup;
  private DifferentialDrive m_driveTrain;
  private Solenoid m_shifter;
  private double m_driveSpeed = 0;
  private double m_turn = 0;
  private double m_maxSpeed = 0.3;

  /**
   * Add your docs here.
   */
  public DriveTrain() {
    super("DriveTrain"); 

    m_motors[0] = new WPI_VictorSPX(RobotMap.LEFT_MOTOR_1);
    m_motors[1] = new WPI_VictorSPX(RobotMap.LEFT_MOTOR_2);
    m_motors[2] = new WPI_VictorSPX(RobotMap.RIGHT_MOTOR_1);
    m_motors[3] = new WPI_VictorSPX(RobotMap.RIGHT_MOTOR_1);
    /*
    
    m_motors[1] = new CANSparkMax(RobotMap.LEFT_MOTOR_1, MotorType.kBrushless);
    m_motors[2] = new CANSparkMax(RobotMap.LEFT_MOTOR_2, MotorType.kBrushless);
    m_motors[3] = new CANSparkMax(RobotMap.LEFT_MOTOR_3, MotorType.kBrushless);
    m_motors[4] = new CANSparkMax(RobotMap.RIGHT_MOTOR_1, MotorType.kBrushless);
    m_motors[5] = new CANSparkMax(RobotMap.RIGHT_MOTOR_2, MotorType.kBrushless);
    m_motors[6] = new CANSparkMax(RobotMap.RIGHT_MOTOR_3, MotorType.kBrushless);
    
    for (int i = 0; i < m_motors.length; i++) {
      m_motorEncoders[i] = new CANEncoder(m_motors[i]);
    }
    
    m_leftMotorGroup = new SpeedControllerGroup(m_motors[1], m_motors[2], m_motors[3]);
    m_rightMotorGroup = new SpeedControllerGroup(m_motors[4], m_motors[5], m_motors[6]);
    */

    m_leftMotorGroup = new SpeedControllerGroup(m_motors[0], m_motors[1]);
    m_rightMotorGroup = new SpeedControllerGroup(m_motors[2], m_motors[3]);

    m_driveTrain = new DifferentialDrive(m_rightMotorGroup, m_leftMotorGroup);
    m_shifter = new Solenoid(RobotMap.SHIFT_SOLENOID);
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
  }

  public void setSolenoid(boolean a) {
    m_shifter.set(a);
  }

  public void shiftUp() {
    Robot.m_driveTrain.setSolenoid(false);
  }

  public void shiftDown() {
    Robot.m_driveTrain.setSolenoid(true);
  }

  public void drive(double speedOne, double speedTwo){
    if (speedOne > m_maxSpeed) speedOne = m_maxSpeed;
    if (speedOne < -m_maxSpeed) speedOne = -m_maxSpeed;
    if (speedTwo > m_maxSpeed) speedTwo = m_maxSpeed;
    if (speedTwo < -m_maxSpeed) speedTwo = -m_maxSpeed;
    m_driveTrain.arcadeDrive(speedOne, speedTwo);
  }

  public void tankDrive(double speedOne, double speedTwo){
    if (speedOne > m_maxSpeed) speedOne = m_maxSpeed;
    if (speedOne < -m_maxSpeed) speedOne = -m_maxSpeed;
    if (speedTwo > m_maxSpeed) speedTwo = m_maxSpeed;
    if (speedTwo < -m_maxSpeed) speedTwo = -m_maxSpeed;
    m_driveTrain.tankDrive(speedOne, speedTwo);
  }

}
