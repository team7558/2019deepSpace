/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import com.ctre.phoenix.sensors.PigeonIMU;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import edu.wpi.first.wpilibj.SpeedControllerGroup;
import edu.wpi.first.wpilibj.command.PIDSubsystem;
import edu.wpi.first.wpilibj.drive.DifferentialDrive;
import frc.robot.RobotMap;
import frc.robot.Robot;

/**
 * Add your docs here.
 */
public class DriveTrain extends PIDSubsystem {
  private PigeonIMU m_pidgey = new PigeonIMU(RobotMap.DRIVE_PIGEON); // 3 is can ID
  private double[] ypr = new double[3];
  private CANSparkMax[] m_motors = new CANSparkMax[7];
  private CANEncoder[] m_motorEncoders = new CANEncoder[7];
  private SpeedControllerGroup m_leftMotorGroup, m_rightMotorGroup;
  private DifferentialDrive m_driveTrain;
  private double targetHeading = 0; 
  /**
   * Add your docs here.
   */
  public DriveTrain() {
    // Intert a subsystem name and PID values here
    super("DriveTrain", 1, 2, 3);  // kp, ki, kd
    setSetpoint(targetHeading);
    enable();

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
    m_driveTrain = new DifferentialDrive(m_leftMotorGroup, m_rightMotorGroup);

  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  @Override
  protected double returnPIDInput() {
    // Return your input value for the PID loop
    m_pidgey.getYawPitchRoll(ypr); // get yaw, pitch, roll and store in ypr array
    // We should add something to check if the value we return makes sense.
    return ypr[0];
  }

  @Override
  protected void usePIDOutput(double output) {
    targetHeading += Robot.m_oi.m_controller_1.getZ();
    setSetpoint(targetHeading);

    m_driveTrain.arcadeDrive(Robot.m_oi.m_controller_1.getX(), output);

  }
}
